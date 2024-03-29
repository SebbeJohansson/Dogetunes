/*!
 * iCheck v0.8 jQuery plugin, http://git.io/uhUPMA
 */
(function(f, k, x, p, h, q, j, n, D, r, C) {
    function y(a, c, g) {
        var d = a[0], b = /ble/.test(g) ? q: h;
        active = "update" == g ? {
            checked: d[h],
            disabled: d[q]
        } : d[b];
        if (/^ch|di/.test(g)&&!active)
            t(a, b);
        else if (/^un|en/.test(g) && active)
            u(a, b);
        else if ("update" == g)
            for (var b in active)
                active[b] ? t(a, b, !0) : u(a, b, !0);
        else if (!c || "toggle" == g)
            c || a.trigger("ifClicked"), active ? d[j] !== p && u(a, b) : t(a, b)
    }
    function t(a, c, g) {
        var d = a[0], b = a.parent(), z = c == q ? "enabled": "un" + h, H = e(a, z + l(d[j])), n = e(a, c + l(d[j]));
        !0 !== d[c]&&!g && (d[c]=!0, a.trigger("ifChanged").trigger("if" +
        l(c)), c == h && (d[j] == p && d.name) && f('input[name="' + d.name + '"]').each(function() {
            this !== d && f(this).data(k) && u(f(this), c)
        }));
        d[q] && e(a, r, !0) && b.find("." + k + "-helper").css(r, "default");
        b.addClass(n || e(a, c));
        b.removeClass(H || e(a, z) || "")
    }
    function u(a, c, g) {
        var d = a[0], b = a.parent(), f = c == q ? "enabled": "un" + h, n = e(a, f + l(d[j])), p = e(a, c + l(d[j]));
        !1 !== d[c]&&!g && (d[c]=!1, a.trigger("ifChanged").trigger("if" + l(f)));
        !d[q] && e(a, r, !0) && b.find("." + k + "-helper").css(r, "pointer");
        b.removeClass(p || e(a, c) || "");
        b.addClass(n || e(a,
        f))
    }
    function E(a, c) {
        a.data(k) && (a.parent().html(a.attr("style", a.data(k).s || "").trigger(c || "")), a.off(".i").unwrap(), f('label[for="' + a[0].id + '"]').add(a.closest("label")).off(".i"))
    }
    function e(a, c, f) {
        if (a.data(k))
            return a.data(k).o[c + (f ? "" : "Class")]
    }
    function l(a) {
        return a.charAt(0).toUpperCase() + a.slice(1)
    }
    f.fn[k] = function(a) {
        var c = navigator.userAgent, g = /ipad|iphone|ipod/i.test(c), d = ":" + x + ", :" + p;
        if (/^(check|uncheck|toggle|disable|enable|update|destroy)$/.test(a))
            return this.each(function() {
                var b =
                f(this);
                (b.is(d) ? b : b.find(d)).each(function() {
                    b = f(this);
                    "destroy" == a ? E(b, "ifDestroyed") : y(b, !0, a)
                })
            });
        if ("object" == typeof a ||!a) {
            var b = f.extend({
                checkedClass: h,
                disabledClass: q,
                labelHover: !0
            }, a), e = b.handle, l = b.hoverClass || "hover", r = b.focusClass || "focus", F = b.activeClass || "active", G=!!b.labelHover, A = b.labelHoverClass || "hover", v = ("" + b.increaseArea).replace("%", "") | 0;
            if (e == x || e == p)
                d = ":" + e;
            -50 > v && (v =- 50);
            return this.each(function() {
                var a = f(this);
                (a.is(d) ? a : a.find(d)).each(function() {
                    a = f(this);
                    E(a);
                    var d =
                    this, e = d.id, B =- v + "%", s = 100 + 2 * v + "%", s = {
                        position: C,
                        top: B,
                        left: B,
                        display: "block",
                        width: s,
                        height: s,
                        margin: 0,
                        padding: 0,
                        background: "#fff",
                        border: 0,
                        opacity: 0
                    }, B = g || /android|blackberry|windows phone|opera mini/i.test(c) ? {
                        position: C,
                        visibility: "hidden"
                    } : v ? s : {
                        position: C,
                        opacity: 0
                    }, z = d[j] == x ? b.checkboxClass || "i" + x : b.radioClass || "i" + p, w = f('label[for="' + e + '"]').add(a.closest("label")), m = a.wrap('<div class="' + z + '"/>').trigger("ifCreated").parent().append(b.insert), s = f('<ins class="' + k + '-helper"/>').css(s).appendTo(m);
                    a.data(k, {
                        o: b,
                        s: a.attr("style")
                    }).css(B);
                    b.inheritClass && m.addClass(d.className);
                    b.inheritID && e && m.attr("id", k + "-" + e);
                    "static" == m.css("position") && m.css("position", "relative");
                    y(a, !0, "update");
                    if (w.length)
                        w.on(n + ".i mouseenter.i mouseleave.i " + D, function(b) {
                            var c = b[j], e = f(this);
                            if (!d[q])
                                if (c == n ? y(a, !1, !0) : G && (/ve|nd/.test(c) ? (m.removeClass(l), e.removeClass(A)) : (m.addClass(l), e.addClass(A)))
                                    , g)b.stopPropagation();
                                else 
                                    return !1
                                });
                    a.on(n + ".i focus.i blur.i keyup.i keydown.i keypress.i", function(b) {
                        var c =
                        b[j];
                        b = b.keyCode;
                        if (c == n)
                            return !1;
                        if ("keydown" == c && 32 == b)
                            return d[j] == p && d[h] || (d[h] ? u(a, h) : t(a, h)), !1;
                        d[j] == p?!d[h] && t(a, h) : /us|ur/.test(c) && ("blur" == c ? m.removeClass(r) : m.addClass(r))
                    });
                    s.on(n + " mousedown mouseup mouseover mouseout " + D, function(b) {
                        var c = b[j], e = /wn|up/.test(c) ? F: l;
                        if (!d[q])
                            if (c == n ? y(a, !1, !0) : (/wn|er|in/.test(c) ? m.addClass(e) : m.removeClass(e + " " + F), w.length && (G && e == l) && (/ut|nd/.test(c) ? w.removeClass(A) : w.addClass(A)))
                                , g)b.stopPropagation();
                        else 
                            return !1
                    })
                })
            })
        }
        return this
    }
})(jQuery,
"iCheck", "checkbox", "radio", "checked", "disabled", "type", "click", "touchbegin.i touchend.i", "cursor", "absolute");
