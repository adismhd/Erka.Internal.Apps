function MoneyFormat(val) {
    //val = Number(val).toFixed();
    val = Number(val);
    var components = val.toString().split(",");
    components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return components.join(",");
}

function TabMoneyFormat(fieldId, val) {
    $('#' + fieldId + '').on("cut copy paste", function (e) {
        e.preventDefault();
    });

    var lastLetter = val[val.length - 1];
    if (!lastLetter.includes(".")) {
        //if (val.includes(".")) {
        //    alert('Dibulatkan');
        //}
        if (val.includes("NaN")) {
            alert('Numeric only')
            val = 0;
        }

        var orig = OriginalFormat(val);
        $('#' + fieldId + '').val(MoneyFormat(orig));
    }
}

function InputMoneyFormat(fieldId, val) {
    $('#' + fieldId + '').on("cut copy paste", function (e) {
        e.preventDefault();
    });

    var lastLetter = val[val.length - 1];
    if (!lastLetter.includes(".")) {
        //if (val.includes(".")) {
        //    alert('Dibulatkan');
        //}
        if (val.includes("NaN")) {
            alert('Numeric only')
            val = 0;
        }

        var orig = OriginalFormat(val);
        $('#' + fieldId + '').val(MoneyFormat(orig));
    }
}

function OriginalFormat(val) {
    if (val !== null && val !== undefined) {
        val = val.toString();
        //var result = (val).replace(/,/g, "")
        var result = val.replaceAll(".", "")
        return Number(result);
    }
}
