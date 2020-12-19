<?php
?>

<script src="/suggestion.js"></script>


<script>
    $(".sForm").submit(function () {
        var allInputs = $(":input");
        allInputs.each(function () {

            var strVal = $.trim($(this).val());
            var lastChar = strVal.slice(-1);
            if (lastChar == ',') {
                strVal = strVal.slice(0, -1);
            }
            $(this).val(strVal);

        });
    });

</script>

