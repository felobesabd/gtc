<?php
 
use Illuminate\Http\UploadedFile;

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
}

/* edit file */
function editFile(
    string $folder,
    Object $obj,
    ?UploadedFile $attachment = null,
    string $relation = 'attach',
    $attach_record_name = 'attachment_id',
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
        /* update attach_record_name  */
        $obj->$attach_record_name = $obj->$relation->id;
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