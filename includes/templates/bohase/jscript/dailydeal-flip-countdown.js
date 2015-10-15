function runCountdown(a, b, c, d, e, f, g, h) {
    var i = !0,
        j = b.split("-"),
        k = c.split(":"),
        l = !0;
    if (jQueryDD("#" + a).countEverest({
            day: j[2],
            month: j[1],
            year: j[0],
            hour: k[0],
            minute: k[1],
            second: k[2],
            currentDateTime: d,
            leftHandZeros: !0,
            daysLabel: e,
            hoursLabel: f,
            minutesLabel: g,
            secondsLabel: h,
            afterCalculation: function() {
                var b = this,
                    c = {
                        days: this.days,
                        hours: this.hours,
                        minutes: this.minutes,
                        seconds: this.seconds
                    },
                    d = {
                        hours: "23",
                        minutes: "59",
                        seconds: "59"
                    },
                    e = "active",
                    f = "before";
                1 == i && (i = !1, jQueryDD("#" + a).find(".unit-wrap div").each(function() {
                    for (var a = jQueryDD(this), b = a.attr("class"), d = c[b], e = "", f = "", g = 0; 10 > g; g++) e += ['<div class="digits-inner">', '<div class="flip-wrap">', '<div class="up">', '<div class="shadow"></div>', '<div class="inn">' + g + "</div>", "</div>", '<div class="down">', '<div class="shadow"></div>', '<div class="inn">' + g + "</div>", "</div>", "</div>", "</div>"].join("");
                    for (var h = 0; h < d.length; h++) f += '<div class="digits">' + e + "</div>";
                    a.append(f)
                })), jQueryDD.each(c, function(c) {
                    var i, g = jQueryDD("#" + a).find("." + c + " .digits").length,
                        h = d[c],
                        j = b.strPad(this, g, "0");
                    "days" == c && "00" == j && l ? (jQueryDD("#" + a).find(".days").parent().remove(), l = !1) : "days" == c && l && (jQueryDD("#" + a).addClass("countdown-days"), l = !1);
                    for (var k = j.length - 1; k >= 0; k--) {
                        var m = jQueryDD("#" + a).find("." + c + " .digits:eq(" + k + ")"),
                            n = m.find("div.digits-inner");
                        i = h ? 0 == h[k] ? 9 : h[k] : 9;
                        var o = parseInt(j[k]),
                            p = o == i ? 0 : o + 1;
                        n.eq(p).hasClass(e) && n.parent().addClass("play"), n.removeClass(e).removeClass(f), n.eq(o).addClass(e), n.eq(p).addClass(f)
                    }
                })
            }
        }), jQueryDD("#" + a).hasClass("countdown-days")) {
        var m = jQueryDD("#" + a).width();
        m >= 220 && 240 > m ? jQueryDD("#" + a).addClass("countdown-large") : m >= 200 && 220 > m ? jQueryDD("#" + a).addClass("countdown-medium") : m >= 170 && 200 > m ? jQueryDD("#" + a).addClass("countdown-small") : 170 > m && jQueryDD("#" + a).addClass("countdown-xsmall")
    } else {
        var m = jQueryDD("#" + a).width();
        m >= 170 && 196 > m ? jQueryDD("#" + a).addClass("countdown-large") : m >= 152 && 170 > m ? jQueryDD("#" + a).addClass("countdown-medium") : m >= 130 && 152 > m ? jQueryDD("#" + a).addClass("countdown-small") : 130 > m && jQueryDD("#" + a).addClass("countdown-xsmall")
    }
    parseInt($(".countdown").css("width")) <= 130 ? $(".title-big").css({
        "font-size": "21px"
    }) : parseInt($(".countdown").css("width")) <= 152 ? $(".title-big").css({
        "font-size": "28px"
    }) : parseInt($(".countdown").css("width")) <= 170 ? $(".title-big").css({
        "font-size": "30px"
    }) : parseInt($(".countdown").css("width")) <= 196 ? $(".title-big").css({
        "font-size": "32px"
    }) : parseInt($(".countdown").css("width")) <= 200 ? $(".title-big").css({
        "font-size": "34px"
    }) : $(".title-big").css({
        "font-size": "37px"
    }), jQueryDD(window).resize(function() {
        if (jQueryDD("#" + a).hasClass("countdown-days")) {
            jQueryDD("#" + a).removeClass("countdown-large countdown-medium countdown-small countdown-xsmall");
            var b = jQueryDD("#" + a).width();
            b >= 220 && 240 > b ? jQueryDD("#" + a).addClass("countdown-large") : b >= 200 && 220 > b ? jQueryDD("#" + a).addClass("countdown-medium") : b >= 170 && 200 > b ? jQueryDD("#" + a).addClass("countdown-small") : 170 > b && jQueryDD("#" + a).addClass("countdown-xsmall")
        } else {
            jQueryDD("#" + a).removeClass("countdown-large countdown-medium countdown-small countdown-xsmall");
            var b = jQueryDD("#" + a).width();
            b >= 170 && 196 > b ? jQueryDD("#" + a).addClass("countdown-large") : b >= 152 && 170 > b ? jQueryDD("#" + a).addClass("countdown-medium") : b >= 130 && 152 > b ? jQueryDD("#" + a).addClass("countdown-small") : 130 > b && jQueryDD("#" + a).addClass("countdown-xsmall")
        }
        parseInt($(".countdown").css("width")) <= 130 ? $(".title-big").css({
            "font-size": "21px"
        }) : parseInt($(".countdown").css("width")) <= 152 ? $(".title-big").css({
            "font-size": "28px"
        }) : parseInt($(".countdown").css("width")) <= 170 ? $(".title-big").css({
            "font-size": "30px"
        }) : parseInt($(".countdown").css("width")) <= 196 ? $(".title-big").css({
            "font-size": "32px"
        }) : parseInt($(".countdown").css("width")) <= 200 ? $(".title-big").css({
            "font-size": "34px"
        }) : $(".title-big").css({
            "font-size": "37px"
        })
    })
}! function(a) {
    function g(b, c) {
        this.element = b, this.settings = a.extend({}, f, c), this._defaults = f, this._name = e, this._serverDate = null, this._javaScriptDate = null, this.currentDate = null, this.targetDate = null, this.days = null, this.hours = null, this.minutes = null, this.seconds = null, this.deciseconds = null, this.milliseconds = null, this.daysLabel = null, this.hoursLabel = null, this.minutesLabel = null, this.secondsLabel = null, this.decisecondsLabel = null, this.millisecondsLabel = null, this._intervalId = null, this._wrapsExists = {}, this._oldValues = {}, this._changed = !1, this.init()
    }
    var e = "countEverest",
        f = {
            day: 1,
            month: 1,
            year: 2050,
            hour: 0,
            minute: 0,
            second: 0,
            millisecond: 0,
            timeZone: null,
            currentDateTime: null,
            daysWrapper: ".ce-days",
            hoursWrapper: ".ce-hours",
            minutesWrapper: ".ce-minutes",
            secondsWrapper: ".ce-seconds",
            decisecondsWrapper: ".ce-dseconds",
            millisecondsWrapper: ".ce-mseconds",
            daysLabelWrapper: ".ce-days-label",
            hoursLabelWrapper: ".ce-hours-label",
            minutesLabelWrapper: ".ce-minutes-label",
            secondsLabelWrapper: ".ce-seconds-label",
            decisecondsLabelWrapper: ".ce-dseconds-label",
            millisecondsLabelWrapper: ".ce-mseconds-label",
            singularLabels: !1,
            daysLabel: "days",
            dayLabel: "day",
            hoursLabel: "hours",
            hourLabel: "hour",
            minutesLabel: "minutes",
            minuteLabel: "minute",
            secondsLabel: "seconds",
            secondLabel: "second",
            decisecondsLabel: "Deciseconds",
            decisecondLabel: "Decisecond",
            millisecondsLabel: "Milliseconds",
            millisecondLabel: "Millisecond",
            timeout: 1e3,
            highspeedTimeout: 4,
            leftHandZeros: !0,
            wrapDigits: !0,
            wrapDigitsTag: "span",
            dayInMilliseconds: 864e5,
            hourInMilliseconds: 36e5,
            minuteInMilliseconds: 6e4,
            secondInMilliseconds: 1e3,
            decisecondInMilliseconds: 100,
            onInit: null,
            beforeCalculation: null,
            afterCalculation: null,
            onCalculation: null,
            onChange: null,
            onComplete: null
        };
    g.prototype = {
        init: function() {
            var b = this,
                c = b.element,
                d = b.settings;
            (a(c).find(d.decisecondsWrapper).length > 0 || a(c).find(d.millisecondsWrapper).length > 0) && (d.timeout = d.highspeedTimeout), null != d.currentDateTime && b.setCurrentDate(d.currentDateTime), a.isFunction(d.onInit) && d.onInit.call(b), b._intervalId = setInterval(function() {
                b.calculate()
            }, d.timeout), b.calculate()
        },
        calculate: function() {
            var b = this,
                c = b.settings,
                d = c.dayInMilliseconds,
                e = c.hourInMilliseconds,
                f = c.minuteInMilliseconds,
                g = c.secondInMilliseconds,
                h = c.decisecondInMilliseconds,
                i = !1;
            b._changed = !1, b.setTargetDate(new Date(c.year, c.month - 1, c.day, c.hour, c.minute, c.second)), a.isFunction(c.beforeCalculation) && c.beforeCalculation.call(b);
            var j = b.getCurrentDate(),
                k = b.getTargetDate(),
                l = j.getTime(),
                m = null === c.timeZone ? 0 : (k.getTimezoneOffset() / 60 + c.timeZone) * c.hourInMilliseconds,
                n = k.getTime() - m,
                o = n - l,
                p = o;
            b.currentDate = j;
            var q = Math.floor(p / d);
            p %= d;
            var r = Math.floor(p / e);
            p %= e;
            var s = Math.floor(p / f);
            p %= f;
            var t = Math.floor(p / g),
                u = p % g,
                v = Math.floor(u / h);
            q = b.naturalNum(q), r = b.naturalNum(r), s = b.naturalNum(s), t = b.naturalNum(t), u = b.naturalNum(u), v = b.naturalNum(v), b.days = q, b.hours = r, b.minutes = s, b.seconds = t, b.milliseconds = u, b.deciseconds = v, b.format(), b.output(), Math.floor(o / c.timeout) <= 0 && (i = !0, (null != c.millisecondsWrapper || null != c.decisecondsWrapper) && (i = 0 >= o ? !0 : !1)), 1 == i && (a.isFunction(c.onComplete) && c.onComplete.call(b), clearInterval(b._intervalId)), a.isFunction(c.onCalculation) && c.onCalculation.call(b), a.isFunction(c.afterCalculation) && c.afterCalculation.call(b)
        },
        format: function() {
            var a = this,
                b = a.settings,
                c = b.singularLabels,
                d = a.days,
                e = a.hours,
                f = a.minutes,
                g = a.seconds,
                h = a.deciseconds,
                i = a.milliseconds,
                j = b.dayLabel,
                k = b.hourLabel,
                l = b.minuteLabel,
                m = b.secondLabel,
                n = b.decisecondLabel,
                o = b.millisecondsLabel;
            1 == b.leftHandZeros && (a.days = a.strPad(d, 2), a.hours = a.strPad(e, 2), a.minutes = a.strPad(f, 2), a.seconds = a.strPad(g, 2), a.milliseconds = a.strPad(i, 3)), a.daysLabel = 1 == d && null !== j && 1 == c ? j : b.daysLabel, a.hoursLabel = 1 == e && null !== k && 1 == c ? k : b.hoursLabel, a.minutesLabel = 1 == f && null !== l && 1 == c ? l : b.minutesLabel, a.secondsLabel = 1 == g && null !== m && 1 == c ? m : b.secondsLabel, a.decisecondsLabel = 1 == h && null !== n && 1 == c ? n : b.decisecondsLabel, a.millisecondsLabel = 1 == i && null !== o && 1 == c ? o : b.millisecondsLabel
        },
        output: function() {
            var b = this,
                c = b.settings;
            b.writeLabelToDom(c.daysLabelWrapper, b.daysLabel), b.writeLabelToDom(c.hoursLabelWrapper, b.hoursLabel), b.writeLabelToDom(c.minutesLabelWrapper, b.minutesLabel), b.writeLabelToDom(c.secondsLabelWrapper, b.secondsLabel), b.writeLabelToDom(c.decisecondsLabelWrapper, b.decisecondsLabel), b.writeLabelToDom(c.millisecondsLabelWrapper, b.millisecondsLabel), b.writeDigitsToDom(c.daysWrapper, b.days, "ce-days-digit"), b.writeDigitsToDom(c.hoursWrapper, b.hours, "ce-hours-digit"), b.writeDigitsToDom(c.minutesWrapper, b.minutes, "ce-minutes-digit"), b.writeDigitsToDom(c.secondsWrapper, b.seconds, "ce-seconds-digit"), b.writeDigitsToDom(c.decisecondsWrapper, b.deciseconds, "ce-dseconds-digit"), b.writeDigitsToDom(c.millisecondsWrapper, b.milliseconds, "ce-mseconds-digit"), a.isFunction(c.onChange) && 1 == b._changed && c.onChange.call(b)
        },
        pause: function() {
            var a = this,
                b = a._intervalId;
            b && clearInterval(b)
        },
        resume: function() {
            var a = this,
                b = a.settings;
            a._intervalId = setInterval(function() {
                a.calculate()
            }, b.timeout)
        },
        destroy: function() {
            var b = this,
                c = b._intervalId;
            a(b.element), c && clearInterval(c)
        },
        getOption: function(a) {
            return this.settings[a]
        },
        setOption: function(a, b) {
            this.settings[a] = b, "currentDateTime" == a && this.setCurrentDate(b)
        },
        setTargetDate: function(a) {
            this.targetDate = a
        },
        getTargetDate: function() {
            return this.targetDate
        },
        setCurrentDate: function(a) {
            this._serverDate = new Date(a), this._javaScriptDate = new Date, this._dateDifference = this._serverDate - this._javaScriptDate
        },
        getCurrentDate: function() {
            var c, d, a = this,
                b = a.settings;
            return null != b.currentDateTime ? (c = a._dateDifference, d = (new Date).getTime(), new Date(d + c)) : new Date
        },
        naturalNum: function(a) {
            return 0 > a ? 0 : a
        },
        strPad: function(a, b, c) {
            var d = a.toString();
            for (c || (c = "0"); d.length < b;) d = c + d;
            return d
        },
        writeLabelToDom: function(b, c) {
            var d = this,
                e = a(d.element);
            null == d._wrapsExists[b] && (d._wrapsExists[b] = e.find(b).length > 0 ? !0 : !1), d._oldValues[b] != c && d._wrapsExists[b] && (d._oldValues[b] = c, e.find(b).text(c), d._changed = !0)
        },
        writeDigitsToDom: function(b, c, d) {
            var j, l, e = this,
                f = e.settings,
                g = f.wrapDigitsTag,
                h = a(e.element),
                i = h.find(b),
                c = c.toString(),
                k = [];
            if (null == e._wrapsExists[b] && (e._wrapsExists[b] = i.length > 0 ? !0 : !1), 0 == e._wrapsExists[b]) return !1;
            if (1 == f.wrapDigits)
                for (var m = 0; m < c.length; m++) k[m] = c[m];
            else k[0] = c;
            if ("undefined" == typeof e._oldValues[b] && (e._oldValues[b] = []), e._oldValues[b].length > k.length) {
                l = e._oldValues[b].length - k.length, j = i.find(g), j.slice(0, l).remove(), j = i.find(g);
                for (var m = 0; m < k.length; m++) j.eq(m).text(k[m]);
                e._changed = !0
            }
            if (e._oldValues[b].length < k.length) {
                if (0 == f.wrapDigits) i.text(k[0]);
                else {
                    0 == e._oldValues[b].length && i.text("");
                    for (var n = "", m = 0; m < k.length; m++) l = k.length - e._oldValues[b].length, l > m ? n += "<" + g + ' class="' + d + '">' + k[m] + "</" + g + ">" : (j = i.find(g), j.eq(m - l).text(k[m]));
                    i.prepend(n)
                }
                e._changed = !0
            }
            if (e._oldValues[b].length == k.length)
                if (0 == f.wrapDigits) e._oldValues[b][0] != k[0] && (i.text(k[0]), e._changed = !0);
                else
                    for (var m = 0; m < k.length; m++) e._oldValues[b][m] != k[m] && (j = i.find(g), j.eq(m).text(k[m]), e._changed = !0);
            e._oldValues[b] = [];
            for (var m = 0; m < k.length; m++) e._oldValues[b][m] = k[m]
        }
    }, a.fn[e] = function(b, c, d) {
        var f = null,
            h = this.each(function() {
                var h = "plugin_",
                    i = null;
                if (a.data(this, h + e)) {
                    if (i = a.data(this, h + e), "destroy" === b) return i.destroy(), a.data(this, h + e, null), void 0;
                    var j = i[b];
                    return "function" == typeof j && (f = j.call(i, c, d)), !1
                }
                i = new g(this, b), a.data(this, h + e, i)
            });
        return f ? f : h
    }
}(jQueryDD, window, document);