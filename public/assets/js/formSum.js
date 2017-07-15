function check_sm() {
        var c_value = 0;
        var sm1 = document.getElementById("sub_category");
        for (var i = 0; i < sm1.length; i++) {
            if (sm1[i].selected)
            { c_value = (eval(c_value) + eval(sm1[i].value)); }
        } //alert(c_value);
    }