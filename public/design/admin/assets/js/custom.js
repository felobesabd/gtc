$(function () {
  var myCursor = $('.mouse-move');
  if (myCursor.length) {
    if ($('body')) {
      const e = document.querySelector('.mouse-inner'),
        t = document.querySelector('.mouse-outer');
      let n, i = 0,
        o = !1;
      window.onmousemove = function (s) {
        o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
      }, $('body').on("mouseenter", "a, .cursor-pointer", function () {
        e.classList.add('mouse-hover'), t.classList.add('mouse-hover')
      }), $('body').on("mouseleave", "a, .cursor-pointer", function () {
        $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove('mouse-hover'), t.classList.remove('mouse-hover'))
      }), e.style.visibility = "visible", t.style.visibility = "visible"
    }
  }
});

function createDatatable(columns, ajax_url, order_option = [0, 'desc']) {
  $datatable = $('.ajax-data-table').DataTable({
    order: [order_option],
    processing: true,
    serverSide: true,
    searching: true,
    scrollX: true,
    columns: columns,
    ajax: ajax_url
  });

  $("#searchbox").keyup(function () {
    $datatable.search(this.value).draw();
  });

  return $datatable;
}

$(document).ready(function () {
    // Suppliers
    $('#add-supplier-details').on('click', function () {
        var clonedSupplier = $('.supplier-details').first().clone();

        clonedSupplier.find('input').each(function () {
            $(this).val('');
        });

        clonedSupplier.addClass('new-item-details').removeAttr('id');

        clonedSupplier.insertBefore('#add-supplier-details');
    });

    $(document).on('click', '.delete-supplier-details', function () {
        const index = $(this).data('index');
        const id = $(this).data('id');

        let deletedSupplierContactIndexes = $('.deleted-supplier-contact-indexes').val();
        deletedSupplierContactIndexes = JSON.parse(deletedSupplierContactIndexes);
        deletedSupplierContactIndexes[index] = id;

        $('.deleted-supplier-contact-indexes').val(JSON.stringify(deletedSupplierContactIndexes));
        // Remove only the closest .item-details div
        $(this).closest('.supplier-details').remove();
    });

    $('#add-supplier-details-edits').on('click', function () {
        var clonedSupplier = $('.supplier-details-hide').first().clone();
        clonedSupplier.show();

        clonedSupplier.find('input').each(function () {
            $(this).val('');
        });

        clonedSupplier.insertBefore('#add-supplier-details-edits');
    });
});
