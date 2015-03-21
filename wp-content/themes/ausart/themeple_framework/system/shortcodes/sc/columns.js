scnShortcodeMeta = {
    attributes: [{
        label: "Columns",
        id: "content",
        controlType: "column-control"
    }],
    disablePreview: true,
    customMakeShortcode: function (b) {
        var a = b.data;
        if (!a) return "";
        b = a.numColumns;
        var c = a.content;
        a = ["0", "one", "two", "three", "four", "five"];
        var x = ["0", "0", "half", "third", "fourth", "0", "sixth"];
        var f = x[b];
        //f += "col_";
        c = c.split("|");
        var g = "";
        for (var h in c) {
            var d = jQuery.trim(c[h]);
            if (d.length > 0) {
                var e = a[d.length] +'_'+f ;
                if (b == 4 && d.length == 2) e = "one_half";
                if (b == 6 && d.length == 3) e = "one_half";
                if (b == 6 && d.length == 2) e = "one_third";
                if (b == 6 && d.length == 4) e = "two_third";
                var z = e;
                if (h == 0) e += ' nr="first"';
                if (h == (b-1)) e+= ' nr="last"';
                g += "[" + e + "]Content for " + d.length + "/" + b + " Column here[/" + z + "] <br/><br/>"
            }
        }
        return g
    }
};