<?php

use App\Models\Attachment;
use App\Models\Freelancer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

function target()
{
    /** @var \App\Models\User $user */
    $user = auth()->user();
    if (!$user) {
        return '/';
    }
    if ($user->hasRole(['admin'])) {
        return 'admin';
    }
    if ($user->hasRole(['customer support'])) {
        return 'customer-support';
    } else return '/';
}

function targetRole(?int $user_id = null, bool $get_freelancer_type = false): ?string
{
    if ($user_id) {
        /** @var \App\Models\User $user */
        $user = User::find($user_id);
    } else {
        /** @var \App\Models\User $user */
        $user = auth()->user();
    }

    if (!$user) {
        return null;
    }
    if ($user->hasRole(['admin'])) {
        $target = 'admin';
    } else if ($user->hasRole(['customer'])) {
        $target = 'customer';
    }
    else if ($user->hasRole(['customer support'])) {
        $target = 'customer-support';
    } else if (!empty($user->freelancer_id)) {
        if ($get_freelancer_type)
            $target = getFreelancerRole(user: $user);
        else
            $target = 'freelancer';
    } else {
        $target = null;
    }
    return $target;
}

function getUserRole(?int $user_id = null): string{
    if ($user_id) {
        /** @var \App\Models\User $user */
        $user = User::find($user_id);
    } else {
        /** @var \App\Models\User $user */
        $user = auth()->user();
    }
    return $user->roles->pluck('name')[0];
}

function getFreelancerRole(User $user): ?string
{
    return Role::findById($user->freelancer_id)?->name;
}

/** edit or create file */
function editOrCreateFile(
    string $folder,
    Object $obj,
    ?UploadedFile $attachment = null,
    string $relation = 'attach',
    $attach_col_name = 'attachment_id',
) {
    if ($attachment) {
        $newname =  $obj->id . '_' . date("d_m_Y") . rand(1, 1000) . time() . '_' . rand(1, 1000) . '.' . $attachment->getClientOriginalExtension();
        $attachment->move(public_path('uploads/' . $folder), $newname);
        if ($obj->$relation?->path) {
            /* delete old file */
            $file_path = public_path($obj->$relation->path);
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }
        /* edit relation database */
        $obj->$relation->fill([
            'name' => $attachment->getClientOriginalName(),
            'path' => $folder . '/' . $newname
        ])->save();
        /* update attach_col_name  */
        $obj->$attach_col_name = $obj->$relation->id;
        $obj->save();
    }
}

/* delete file */
function deleteFile(object $obj, string $relation = 'attach')
{
    if ($obj->$relation?->path) {
        $file_path = public_path($obj->$relation->path);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $obj->$relation->delete();
    }
}

/** edit or create multiple files */
function editOrCreateMultipleFiles(
    string $folder,
    Object $obj,
    array $attachments = [],
    string $attach_col_name = 'attachments_ids',
) {
    if (!empty($attachments)) {
        $new_attachments_ids = [];
        foreach ($attachments as $attachment) {
            $newname =  $obj->id . '_' . date("d_m_Y") . rand(1, 1000) . time() . '_' . rand(1, 1000) . '.' . $attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/' . $folder), $newname);
            if (!empty($obj->{$attach_col_name})) {
                /* delete old files */
                deleteMultipleFiles(obj: $obj, attach_col_name: $attach_col_name);
            }
            /* save in Attachment database */
            $new_attachment = Attachment::create([
                'name' => $attachment->getClientOriginalName(),
                'path' => $folder . '/' . $newname
            ]);
            $new_attachments_ids[] = $new_attachment->id;
        }
        /* update attach_col_name  */
        $obj->{$attach_col_name} = json_encode($new_attachments_ids);
        $obj->save();
    }
}

/* delete multiple files */
function deleteMultipleFiles(object $obj, string $attach_col_name = 'attachments_ids')
{
    $attachments = getMultipleAttachments(
        obj: $obj,
        attach_col_name: $attach_col_name,
    );
    foreach ($attachments as $attachment) {
        $file_path = public_path($attachment->path);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $attachment->delete();
    }
    $obj->$attach_col_name = [];
    $obj->save();
}

/** get multiple attachments */
function getMultipleAttachments(
    Object $obj,
    string $attach_col_name = '',
): Collection {
    $attach_ids = json_decode($obj->{$attach_col_name});
    return Attachment::whereIn('id', $attach_ids)->get();
}

/**
 * we use this function when edit or create object
 * call before editing but after creating object
 * @param string $model
 * @param Integer $min_ordering
 * @param object $obj
 * @return void
 */
function ordering(string $model, object $obj, ?int $new_ordering = null): void
{
    /** if editing */
    if ($new_ordering) {
        /** check that ordering changed for that object */
        if ($new_ordering != $obj->ordering) {
            /** check if no object exist equals this ordering */
            $exist_ordering = $model::query()
                ->where('ordering', $new_ordering)->first();
            if (!is_object($exist_ordering)) {
                return;
            }
            /** end check if no object exist equals this ordering */

            $model::query()
                ->where('ordering', '>=', $new_ordering)
                ->update([
                    'ordering' => DB::raw("ordering + 1")
                ]);
        }
    }
    /** if creating */
    else {
        $model::query()
            ->where('id', '!=', $obj->id)
            ->update([
                'ordering' => DB::raw("ordering + 1")
            ]);
    }
}


function formatName(string $word): string
{
    $res = str_replace('_', ' ', $word);
    return ucwords(strtolower($res));
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $fileName = $image->hashName();
    $path = 'images/'. $folder . '/' . $fileName;
    return $fileName;
}

//function uploadImage($folder, $image) {
//    Storage::disk($folder)->put('/',  $image);
//    return  'uploads/' . $image;
//}
