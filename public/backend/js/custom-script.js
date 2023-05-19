$(document).ready(function () {
    $(document).on("click", ".dlt_btn", function (e) {
        e.preventDefault();

        let dltform = $(this).data("dltform");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(`form#${dltform}`).submit();
            }
        });
    });

    //permission role select and unselect script
    $(document).on("change", "#allPermission", function () {
        if ($(this).prop("checked")) {
            $("input[type=checkbox]").prop("checked", true);
        } else {
            $("input[type=checkbox]").prop("checked", false);
        }
    });

    $(document).on("change", ".perGrpName", function (e) {
        e.preventDefault();

        let target = $(this);
        let gname = $(this).data("gname");
        if (target.prop("checked")) {
            $("." + gname).prop("checked", true);
        } else {
            $("." + gname).prop("checked", false);
        }

        singlepermissionwiseAllpermissionCheckboxCheck();
        // console.log(gname);
    });

    $(document).on("change", ".singPerName", function (e) {
        e.preventDefault();
        let gname = $(this).data("gname");
        let singPermissonArray = [];
        $("." + gname).each(function () {
            if ($(this).prop("checked")) {
                singPermissonArray.push(1);
            } else {
                singPermissonArray.push(0);
            }
        });
        if ($.inArray(0, singPermissonArray) != -1) {
            $("#" + gname).prop("checked", false);
        } else {
            $("#" + gname).prop("checked", true);
        }
        singlepermissionwiseAllpermissionCheckboxCheck();
        // console.log(gname);
    });

    function singlepermissionwiseAllpermissionCheckboxCheck() {
        let permissonArray = [];
        $(".singPerName").each(function () {
            if (!$(this).prop("checked")) {
                permissonArray.push(0);
            } else {
                permissonArray.push(1);
            }
        });

        if ($.inArray(0, permissonArray) != -1) {
            $("#allPermission").prop("checked", false);
        } else {
            $("#allPermission").prop("checked", true);
        }
        // console.log(permissonArray);
    }
    // end
});
