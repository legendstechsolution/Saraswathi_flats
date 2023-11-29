/* @preserve
    _____ __ _     __                _
   / ___// /(_)___/ /___  ____      (_)___
  / (_ // // // _  // -_)/ __/_    / /(_-<
  \___//_//_/ \_,_/ \__//_/  (_)__/ //___/
                              |___/

  Version: 1.7.4
  Author: Nick Piscitelli (pickykneee)
  Website: https://nickpiscitelli.com
  Documentation: http://nickpiscitelli.github.io/Glider.js
  License: MIT License
  Release Date: October 25th, 2018

*/
!(function (e) {
  "function" == typeof define && define.amd
    ? define(e)
    : "object" == typeof exports
    ? (module.exports = e())
    : e();
})(function () {
  var a = "undefined" != typeof window ? window : this,
    e = (a.Glider = function (e, t) {
      var o = this;
      if (e._glider) return e._glider;
      if (
        ((o.ele = e),
        o.ele.classList.add("glider"),
        ((o.ele._glider = o).opt = Object.assign(
          {},
          {
            slidesToScroll: 1,
            slidesToShow: 1,
            resizeLock: !0,
            duration: 0.5,
            easing: function (e, t, o, i, r) {
              return i * (t /= r) * t + o;
            },
          },
          t
        )),
        (o.animate_id = o.page = o.slide = 0),
        (o.arrows = {}),
        (o._opt = o.opt),
        o.opt.skipTrack)
      )
        o.track = o.ele.children[0];
      else
        for (
          o.track = document.createElement("div"), o.ele.appendChild(o.track);
          1 !== o.ele.children.length;

        )
          o.track.appendChild(o.ele.children[0]);
      o.track.classList.add("glider-track"),
        o.init(),
        (o.resize = o.init.bind(o, !0)),
        o.event(o.ele, "add", { scroll: o.updateControls.bind(o) }),
        o.event(a, "add", { resize: o.resize });
    }),
    t = e.prototype;
  return (
    (t.init = function (e, t) {
      var o = this,
        i = 0,
        r = 0;
      (o.slides = o.track.children),
        [].forEach.call(o.slides, function (e) {
          e.classList.add("glider-slide");
        }),
        (o.containerWidth = o.ele.clientWidth);
      var s = o.settingsBreakpoint();
      if (
        ((t = t || s),
        "auto" === o.opt.slidesToShow || void 0 !== o.opt._autoSlide)
      ) {
        var l = o.containerWidth / o.opt.itemWidth;
        o.opt._autoSlide = o.opt.slidesToShow = o.opt.exactWidth
          ? l
          : Math.floor(l);
      }
      "auto" === o.opt.slidesToScroll &&
        (o.opt.slidesToScroll = Math.floor(o.opt.slidesToShow)),
        (o.itemWidth = o.opt.exactWidth
          ? o.opt.itemWidth
          : o.containerWidth / o.opt.slidesToShow),
        [].forEach.call(o.slides, function (e) {
          (e.style.height = "auto"),
            (e.style.width = o.itemWidth + "px"),
            (i += o.itemWidth),
            (r = Math.max(e.offsetHeight, r));
        }),
        (o.track.style.width = i + "px"),
        (o.trackWidth = i),
        (o.isDrag = !1),
        (o.preventClick = !1),
        o.opt.resizeLock && o.scrollTo(o.slide * o.itemWidth, 0),
        (s || t) && (o.bindArrows(), o.buildDots(), o.bindDrag()),
        o.updateControls(),
        o.emit(e ? "refresh" : "loaded");
    }),
    (t.bindDrag = function () {
      var t = this;
      t.mouse = t.mouse || t.handleMouse.bind(t);
      function e() {
        (t.mouseDown = void 0),
          t.ele.classList.remove("drag"),
          t.isDrag && (t.preventClick = !0),
          (t.isDrag = !1);
      }
      var o = {
        mouseup: e,
        mouseleave: e,
        mousedown: function (e) {
          e.preventDefault(),
            e.stopPropagation(),
            (t.mouseDown = e.clientX),
            t.ele.classList.add("drag");
        },
        mousemove: t.mouse,
        click: function (e) {
          t.preventClick && (e.preventDefault(), e.stopPropagation()),
            (t.preventClick = !1);
        },
      };
      t.ele.classList.toggle("draggable", !0 === t.opt.draggable),
        t.event(t.ele, "remove", o),
        t.opt.draggable && t.event(t.ele, "add", o);
    }),
    (t.buildDots = function () {
      var e = this;
      if (e.opt.dots) {
        if (
          ("string" == typeof e.opt.dots
            ? (e.dots = document.querySelector(e.opt.dots))
            : (e.dots = e.opt.dots),
          e.dots)
        ) {
          (e.dots.innerHTML = ""), e.dots.classList.add("glider-dots");
          for (
            var t = 0;
            t < Math.ceil(e.slides.length / e.opt.slidesToShow);
            ++t
          ) {
            var o = document.createElement("button");
            (o.dataset.index = t),
              o.setAttribute("aria-label", "Page " + (t + 1)),
              (o.className = "glider-dot " + (t ? "" : "active")),
              e.event(o, "add", { click: e.scrollItem.bind(e, t, !0) }),
              e.dots.appendChild(o);
          }
        }
      } else e.dots && (e.dots.innerHTML = "");
    }),
    (t.bindArrows = function () {
      var o = this;
      o.opt.arrows
        ? ["prev", "next"].forEach(function (e) {
            var t = o.opt.arrows[e];
            t &&
              ("string" == typeof t && (t = document.querySelector(t)),
              (t._func = t._func || o.scrollItem.bind(o, e)),
              o.event(t, "remove", { click: t._func }),
              o.event(t, "add", { click: t._func }),
              (o.arrows[e] = t));
          })
        : Object.keys(o.arrows).forEach(function (e) {
            var t = o.arrows[e];
            o.event(t, "remove", { click: t._func });
          });
    }),
    (t.updateControls = function (e) {
      var d = this;
      e && !d.opt.scrollPropagate && e.stopPropagation();
      var t = d.containerWidth >= d.trackWidth;
      d.opt.rewind ||
        (d.arrows.prev &&
          d.arrows.prev.classList.toggle(
            "disabled",
            d.ele.scrollLeft <= 0 || t
          ),
        d.arrows.next &&
          d.arrows.next.classList.toggle(
            "disabled",
            Math.ceil(d.ele.scrollLeft + d.containerWidth) >=
              Math.floor(d.trackWidth) || t
          )),
        (d.slide = Math.round(d.ele.scrollLeft / d.itemWidth)),
        (d.page = Math.round(d.ele.scrollLeft / d.containerWidth));
      var c = d.slide + Math.floor(Math.floor(d.opt.slidesToShow) / 2),
        h = Math.floor(d.opt.slidesToShow) % 2 ? 0 : c + 1;
      1 === Math.floor(d.opt.slidesToShow) && (h = 0),
        d.ele.scrollLeft + d.containerWidth >= Math.floor(d.trackWidth) &&
          (d.page = d.dots ? d.dots.children.length - 1 : 0),
        [].forEach.call(d.slides, function (e, t) {
          var o = e.classList,
            i = o.contains("visible"),
            r = d.ele.scrollLeft,
            s = d.ele.scrollLeft + d.containerWidth,
            l = d.itemWidth * t,
            n = l + d.itemWidth;
          [].forEach.call(o, function (e) {
            /^left|right/.test(e) && o.remove(e);
          }),
            o.toggle("active", d.slide === t),
            c === t || (h && h === t)
              ? o.add("center")
              : (o.remove("center"),
                o.add(
                  [
                    t < c ? "left" : "right",
                    Math.abs(t - (t < c ? c : h || c)),
                  ].join("-")
                ));
          var a = Math.ceil(l) >= r && Math.floor(n) <= s;
          o.toggle("visible", a),
            a !== i &&
              d.emit("slide-" + (a ? "visible" : "hidden"), { slide: t });
        }),
        d.dots &&
          [].forEach.call(d.dots.children, function (e, t) {
            e.classList.toggle("active", d.page === t);
          }),
        e &&
          d.opt.scrollLock &&
          (clearTimeout(d.scrollLock),
          (d.scrollLock = setTimeout(function () {
            clearTimeout(d.scrollLock),
              0.02 < Math.abs(d.ele.scrollLeft / d.itemWidth - d.slide) &&
                (d.mouseDown ||
                  (d.trackWidth > d.containerWidth + d.ele.scrollLeft &&
                    d.scrollItem(d.getCurrentSlide())));
          }, d.opt.scrollLockDelay || 250)));
    }),
    (t.getCurrentSlide = function () {
      var e = this;
      return e.round(e.ele.scrollLeft / e.itemWidth);
    }),
    (t.scrollItem = function (e, t, o) {
      o && o.preventDefault();
      var i = this,
        r = e;
      if ((++i.animate_id, !0 === t))
        (e *= i.containerWidth),
          (e = Math.round(e / i.itemWidth) * i.itemWidth);
      else {
        if ("string" == typeof e) {
          var s = "prev" === e;
          if (
            ((e =
              i.opt.slidesToScroll % 1 || i.opt.slidesToShow % 1
                ? i.getCurrentSlide()
                : i.slide),
            s ? (e -= i.opt.slidesToScroll) : (e += i.opt.slidesToScroll),
            i.opt.rewind)
          ) {
            var l = i.ele.scrollLeft;
            e =
              s && !l
                ? i.slides.length
                : !s && l + i.containerWidth >= Math.floor(i.trackWidth)
                ? 0
                : e;
          }
        }
        (e = Math.max(Math.min(e, i.slides.length), 0)),
          (i.slide = e),
          (e = i.itemWidth * e);
      }
      return (
        i.scrollTo(
          e,
          i.opt.duration * Math.abs(i.ele.scrollLeft - e),
          function () {
            i.updateControls(),
              i.emit("animated", {
                value: r,
                type: "string" == typeof r ? "arrow" : t ? "dot" : "slide",
              });
          }
        ),
        !1
      );
    }),
    (t.settingsBreakpoint = function () {
      var e = this,
        t = e._opt.responsive;
      if (t) {
        t.sort(function (e, t) {
          return t.breakpoint - e.breakpoint;
        });
        for (var o = 0; o < t.length; ++o) {
          var i = t[o];
          if (a.innerWidth >= i.breakpoint)
            return (
              e.breakpoint !== i.breakpoint &&
              ((e.opt = Object.assign({}, e._opt, i.settings)),
              (e.breakpoint = i.breakpoint),
              !0)
            );
        }
      }
      var r = 0 !== e.breakpoint;
      return (e.opt = Object.assign({}, e._opt)), (e.breakpoint = 0), r;
    }),
    (t.scrollTo = function (t, o, i) {
      var r = this,
        s = new Date().getTime(),
        l = r.animate_id,
        n = function () {
          var e = new Date().getTime() - s;
          (r.ele.scrollLeft =
            r.ele.scrollLeft +
            (t - r.ele.scrollLeft) * r.opt.easing(0, e, 0, 1, o)),
            e < o && l === r.animate_id
              ? a.requestAnimationFrame(n)
              : ((r.ele.scrollLeft = t), i && i.call(r));
        };
      a.requestAnimationFrame(n);
    }),
    (t.removeItem = function (e) {
      var t = this;
      t.slides.length &&
        (t.track.removeChild(t.slides[e]), t.refresh(!0), t.emit("remove"));
    }),
    (t.addItem = function (e) {
      this.track.appendChild(e), this.refresh(!0), this.emit("add");
    }),
    (t.handleMouse = function (e) {
      var t = this;
      t.mouseDown &&
        ((t.isDrag = !0),
        (t.ele.scrollLeft +=
          (t.mouseDown - e.clientX) * (t.opt.dragVelocity || 3.3)),
        (t.mouseDown = e.clientX));
    }),
    (t.round = function (e) {
      var t = 1 / (this.opt.slidesToScroll % 1 || 1);
      return Math.round(e * t) / t;
    }),
    (t.refresh = function (e) {
      this.init(!0, e);
    }),
    (t.setOption = function (t, e) {
      var o = this;
      o.breakpoint && !e
        ? o._opt.responsive.forEach(function (e) {
            e.breakpoint === o.breakpoint &&
              (e.settings = Object.assign({}, e.settings, t));
          })
        : (o._opt = Object.assign({}, o._opt, t)),
        (o.breakpoint = 0),
        o.settingsBreakpoint();
    }),
    (t.destroy = function () {
      function e(t) {
        t.removeAttribute("style"),
          [].forEach.call(t.classList, function (e) {
            /^glider/.test(e) && t.classList.remove(e);
          });
      }
      var t = this,
        o = t.ele.cloneNode(!0);
      (o.children[0].outerHTML = o.children[0].innerHTML),
        e(o),
        [].forEach.call(o.getElementsByTagName("*"), e),
        t.ele.parentNode.replaceChild(o, t.ele),
        t.event(a, "remove", { resize: t.resize }),
        t.emit("destroy");
    }),
    (t.emit = function (e, t) {
      var o = new a.CustomEvent("glider-" + e, {
        bubbles: !this.opt.eventPropagate,
        detail: t,
      });
      this.ele.dispatchEvent(o);
    }),
    (t.event = function (e, t, o) {
      var i = e[t + "EventListener"].bind(e);
      Object.keys(o).forEach(function (e) {
        i(e, o[e]);
      });
    }),
    e
  );
});

/*!
 * Bootstrap v3.3.5 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery)
  throw new Error("Bootstrap's JavaScript requires jQuery");
+(function (a) {
  "use strict";
  var b = a.fn.jquery.split(" ")[0].split(".");
  if ((b[0] < 2 && b[1] < 9) || (1 == b[0] && 9 == b[1] && b[2] < 1))
    throw new Error(
      "Bootstrap's JavaScript requires jQuery version 1.9.1 or higher"
    );
})(jQuery),
  +(function (a) {
    "use strict";
    function b() {
      var a = document.createElement("bootstrap"),
        b = {
          WebkitTransition: "webkitTransitionEnd",
          MozTransition: "transitionend",
          OTransition: "oTransitionEnd otransitionend",
          transition: "transitionend",
        };
      for (var c in b) if (void 0 !== a.style[c]) return { end: b[c] };
      return !1;
    }
    (a.fn.emulateTransitionEnd = function (b) {
      var c = !1,
        d = this;
      a(this).one("bsTransitionEnd", function () {
        c = !0;
      });
      var e = function () {
        c || a(d).trigger(a.support.transition.end);
      };
      return setTimeout(e, b), this;
    }),
      a(function () {
        (a.support.transition = b()),
          a.support.transition &&
            (a.event.special.bsTransitionEnd = {
              bindType: a.support.transition.end,
              delegateType: a.support.transition.end,
              handle: function (b) {
                return a(b.target).is(this)
                  ? b.handleObj.handler.apply(this, arguments)
                  : void 0;
              },
            });
      });
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var c = a(this),
          e = c.data("bs.alert");
        e || c.data("bs.alert", (e = new d(this))),
          "string" == typeof b && e[b].call(c);
      });
    }
    var c = '[data-dismiss="alert"]',
      d = function (b) {
        a(b).on("click", c, this.close);
      };
    (d.VERSION = "3.3.5"),
      (d.TRANSITION_DURATION = 150),
      (d.prototype.close = function (b) {
        function c() {
          g.detach().trigger("closed.bs.alert").remove();
        }
        var e = a(this),
          f = e.attr("data-target");
        f || ((f = e.attr("href")), (f = f && f.replace(/.*(?=#[^\s]*$)/, "")));
        var g = a(f);
        b && b.preventDefault(),
          g.length || (g = e.closest(".alert")),
          g.trigger((b = a.Event("close.bs.alert"))),
          b.isDefaultPrevented() ||
            (g.removeClass("in"),
            a.support.transition && g.hasClass("fade")
              ? g
                  .one("bsTransitionEnd", c)
                  .emulateTransitionEnd(d.TRANSITION_DURATION)
              : c());
      });
    var e = a.fn.alert;
    (a.fn.alert = b),
      (a.fn.alert.Constructor = d),
      (a.fn.alert.noConflict = function () {
        return (a.fn.alert = e), this;
      }),
      a(document).on("click.bs.alert.data-api", c, d.prototype.close);
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.button"),
          f = "object" == typeof b && b;
        e || d.data("bs.button", (e = new c(this, f))),
          "toggle" == b ? e.toggle() : b && e.setState(b);
      });
    }
    var c = function (b, d) {
      (this.$element = a(b)),
        (this.options = a.extend({}, c.DEFAULTS, d)),
        (this.isLoading = !1);
    };
    (c.VERSION = "3.3.5"),
      (c.DEFAULTS = { loadingText: "loading..." }),
      (c.prototype.setState = function (b) {
        var c = "disabled",
          d = this.$element,
          e = d.is("input") ? "val" : "html",
          f = d.data();
        (b += "Text"),
          null == f.resetText && d.data("resetText", d[e]()),
          setTimeout(
            a.proxy(function () {
              d[e](null == f[b] ? this.options[b] : f[b]),
                "loadingText" == b
                  ? ((this.isLoading = !0), d.addClass(c).attr(c, c))
                  : this.isLoading &&
                    ((this.isLoading = !1), d.removeClass(c).removeAttr(c));
            }, this),
            0
          );
      }),
      (c.prototype.toggle = function () {
        var a = !0,
          b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
          var c = this.$element.find("input");
          "radio" == c.prop("type")
            ? (c.prop("checked") && (a = !1),
              b.find(".active").removeClass("active"),
              this.$element.addClass("active"))
            : "checkbox" == c.prop("type") &&
              (c.prop("checked") !== this.$element.hasClass("active") &&
                (a = !1),
              this.$element.toggleClass("active")),
            c.prop("checked", this.$element.hasClass("active")),
            a && c.trigger("change");
        } else
          this.$element.attr("aria-pressed", !this.$element.hasClass("active")),
            this.$element.toggleClass("active");
      });
    var d = a.fn.button;
    (a.fn.button = b),
      (a.fn.button.Constructor = c),
      (a.fn.button.noConflict = function () {
        return (a.fn.button = d), this;
      }),
      a(document)
        .on(
          "click.bs.button.data-api",
          '[data-toggle^="button"]',
          function (c) {
            var d = a(c.target);
            d.hasClass("btn") || (d = d.closest(".btn")),
              b.call(d, "toggle"),
              a(c.target).is('input[type="radio"]') ||
                a(c.target).is('input[type="checkbox"]') ||
                c.preventDefault();
          }
        )
        .on(
          "focus.bs.button.data-api blur.bs.button.data-api",
          '[data-toggle^="button"]',
          function (b) {
            a(b.target)
              .closest(".btn")
              .toggleClass("focus", /^focus(in)?$/.test(b.type));
          }
        );
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.carousel"),
          f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
          g = "string" == typeof b ? b : f.slide;
        e || d.data("bs.carousel", (e = new c(this, f))),
          "number" == typeof b
            ? e.to(b)
            : g
            ? e[g]()
            : f.interval && e.pause().cycle();
      });
    }
    var c = function (b, c) {
      (this.$element = a(b)),
        (this.$indicators = this.$element.find(".carousel-indicators")),
        (this.options = c),
        (this.paused = null),
        (this.sliding = null),
        (this.interval = null),
        (this.$active = null),
        (this.$items = null),
        this.options.keyboard &&
          this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)),
        "hover" == this.options.pause &&
          !("ontouchstart" in document.documentElement) &&
          this.$element
            .on("mouseenter.bs.carousel", a.proxy(this.pause, this))
            .on("mouseleave.bs.carousel", a.proxy(this.cycle, this));
    };
    (c.VERSION = "3.3.5"),
      (c.TRANSITION_DURATION = 600),
      (c.DEFAULTS = { interval: 5e3, pause: "hover", wrap: !0, keyboard: !0 }),
      (c.prototype.keydown = function (a) {
        if (!/input|textarea/i.test(a.target.tagName)) {
          switch (a.which) {
            case 37:
              this.prev();
              break;
            case 39:
              this.next();
              break;
            default:
              return;
          }
          a.preventDefault();
        }
      }),
      (c.prototype.cycle = function (b) {
        return (
          b || (this.paused = !1),
          this.interval && clearInterval(this.interval),
          this.options.interval &&
            !this.paused &&
            (this.interval = setInterval(
              a.proxy(this.next, this),
              this.options.interval
            )),
          this
        );
      }),
      (c.prototype.getItemIndex = function (a) {
        return (
          (this.$items = a.parent().children(".item")),
          this.$items.index(a || this.$active)
        );
      }),
      (c.prototype.getItemForDirection = function (a, b) {
        var c = this.getItemIndex(b),
          d =
            ("prev" == a && 0 === c) ||
            ("next" == a && c == this.$items.length - 1);
        if (d && !this.options.wrap) return b;
        var e = "prev" == a ? -1 : 1,
          f = (c + e) % this.$items.length;
        return this.$items.eq(f);
      }),
      (c.prototype.to = function (a) {
        var b = this,
          c = this.getItemIndex(
            (this.$active = this.$element.find(".item.active"))
          );
        return a > this.$items.length - 1 || 0 > a
          ? void 0
          : this.sliding
          ? this.$element.one("slid.bs.carousel", function () {
              b.to(a);
            })
          : c == a
          ? this.pause().cycle()
          : this.slide(a > c ? "next" : "prev", this.$items.eq(a));
      }),
      (c.prototype.pause = function (b) {
        return (
          b || (this.paused = !0),
          this.$element.find(".next, .prev").length &&
            a.support.transition &&
            (this.$element.trigger(a.support.transition.end), this.cycle(!0)),
          (this.interval = clearInterval(this.interval)),
          this
        );
      }),
      (c.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next");
      }),
      (c.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev");
      }),
      (c.prototype.slide = function (b, d) {
        var e = this.$element.find(".item.active"),
          f = d || this.getItemForDirection(b, e),
          g = this.interval,
          h = "next" == b ? "left" : "right",
          i = this;
        if (f.hasClass("active")) return (this.sliding = !1);
        var j = f[0],
          k = a.Event("slide.bs.carousel", { relatedTarget: j, direction: h });
        if ((this.$element.trigger(k), !k.isDefaultPrevented())) {
          if (
            ((this.sliding = !0), g && this.pause(), this.$indicators.length)
          ) {
            this.$indicators.find(".active").removeClass("active");
            var l = a(this.$indicators.children()[this.getItemIndex(f)]);
            l && l.addClass("active");
          }
          var m = a.Event("slid.bs.carousel", {
            relatedTarget: j,
            direction: h,
          });
          return (
            a.support.transition && this.$element.hasClass("slide")
              ? (f.addClass(b),
                f[0].offsetWidth,
                e.addClass(h),
                f.addClass(h),
                e
                  .one("bsTransitionEnd", function () {
                    f.removeClass([b, h].join(" ")).addClass("active"),
                      e.removeClass(["active", h].join(" ")),
                      (i.sliding = !1),
                      setTimeout(function () {
                        i.$element.trigger(m);
                      }, 0);
                  })
                  .emulateTransitionEnd(c.TRANSITION_DURATION))
              : (e.removeClass("active"),
                f.addClass("active"),
                (this.sliding = !1),
                this.$element.trigger(m)),
            g && this.cycle(),
            this
          );
        }
      });
    var d = a.fn.carousel;
    (a.fn.carousel = b),
      (a.fn.carousel.Constructor = c),
      (a.fn.carousel.noConflict = function () {
        return (a.fn.carousel = d), this;
      });
    var e = function (c) {
      var d,
        e = a(this),
        f = a(
          e.attr("data-target") ||
            ((d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""))
        );
      if (f.hasClass("carousel")) {
        var g = a.extend({}, f.data(), e.data()),
          h = e.attr("data-slide-to");
        h && (g.interval = !1),
          b.call(f, g),
          h && f.data("bs.carousel").to(h),
          c.preventDefault();
      }
    };
    a(document)
      .on("click.bs.carousel.data-api", "[data-slide]", e)
      .on("click.bs.carousel.data-api", "[data-slide-to]", e),
      a(window).on("load", function () {
        a('[data-ride="carousel"]').each(function () {
          var c = a(this);
          b.call(c, c.data());
        });
      });
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      var c,
        d =
          b.attr("data-target") ||
          ((c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, ""));
      return a(d);
    }
    function c(b) {
      return this.each(function () {
        var c = a(this),
          e = c.data("bs.collapse"),
          f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
        !e && f.toggle && /show|hide/.test(b) && (f.toggle = !1),
          e || c.data("bs.collapse", (e = new d(this, f))),
          "string" == typeof b && e[b]();
      });
    }
    var d = function (b, c) {
      (this.$element = a(b)),
        (this.options = a.extend({}, d.DEFAULTS, c)),
        (this.$trigger = a(
          '[data-toggle="collapse"][href="#' +
            b.id +
            '"],[data-toggle="collapse"][data-target="#' +
            b.id +
            '"]'
        )),
        (this.transitioning = null),
        this.options.parent
          ? (this.$parent = this.getParent())
          : this.addAriaAndCollapsedClass(this.$element, this.$trigger),
        this.options.toggle && this.toggle();
    };
    (d.VERSION = "3.3.5"),
      (d.TRANSITION_DURATION = 350),
      (d.DEFAULTS = { toggle: !0 }),
      (d.prototype.dimension = function () {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height";
      }),
      (d.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
          var b,
            e =
              this.$parent &&
              this.$parent.children(".panel").children(".in, .collapsing");
          if (
            !(
              e &&
              e.length &&
              ((b = e.data("bs.collapse")), b && b.transitioning)
            )
          ) {
            var f = a.Event("show.bs.collapse");
            if ((this.$element.trigger(f), !f.isDefaultPrevented())) {
              e &&
                e.length &&
                (c.call(e, "hide"), b || e.data("bs.collapse", null));
              var g = this.dimension();
              this.$element
                .removeClass("collapse")
                .addClass("collapsing")
                [g](0)
                .attr("aria-expanded", !0),
                this.$trigger
                  .removeClass("collapsed")
                  .attr("aria-expanded", !0),
                (this.transitioning = 1);
              var h = function () {
                this.$element
                  .removeClass("collapsing")
                  .addClass("collapse in")
                  [g](""),
                  (this.transitioning = 0),
                  this.$element.trigger("shown.bs.collapse");
              };
              if (!a.support.transition) return h.call(this);
              var i = a.camelCase(["scroll", g].join("-"));
              this.$element
                .one("bsTransitionEnd", a.proxy(h, this))
                .emulateTransitionEnd(d.TRANSITION_DURATION)
                [g](this.$element[0][i]);
            }
          }
        }
      }),
      (d.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
          var b = a.Event("hide.bs.collapse");
          if ((this.$element.trigger(b), !b.isDefaultPrevented())) {
            var c = this.dimension();
            this.$element[c](this.$element[c]())[0].offsetHeight,
              this.$element
                .addClass("collapsing")
                .removeClass("collapse in")
                .attr("aria-expanded", !1),
              this.$trigger.addClass("collapsed").attr("aria-expanded", !1),
              (this.transitioning = 1);
            var e = function () {
              (this.transitioning = 0),
                this.$element
                  .removeClass("collapsing")
                  .addClass("collapse")
                  .trigger("hidden.bs.collapse");
            };
            return a.support.transition
              ? void this.$element[c](0)
                  .one("bsTransitionEnd", a.proxy(e, this))
                  .emulateTransitionEnd(d.TRANSITION_DURATION)
              : e.call(this);
          }
        }
      }),
      (d.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]();
      }),
      (d.prototype.getParent = function () {
        return a(this.options.parent)
          .find(
            '[data-toggle="collapse"][data-parent="' +
              this.options.parent +
              '"]'
          )
          .each(
            a.proxy(function (c, d) {
              var e = a(d);
              this.addAriaAndCollapsedClass(b(e), e);
            }, this)
          )
          .end();
      }),
      (d.prototype.addAriaAndCollapsedClass = function (a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c),
          b.toggleClass("collapsed", !c).attr("aria-expanded", c);
      });
    var e = a.fn.collapse;
    (a.fn.collapse = c),
      (a.fn.collapse.Constructor = d),
      (a.fn.collapse.noConflict = function () {
        return (a.fn.collapse = e), this;
      }),
      a(document).on(
        "click.bs.collapse.data-api",
        '[data-toggle="collapse"]',
        function (d) {
          var e = a(this);
          e.attr("data-target") || d.preventDefault();
          var f = b(e),
            g = f.data("bs.collapse"),
            h = g ? "toggle" : e.data();
          c.call(f, h);
        }
      );
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      var c = b.attr("data-target");
      c ||
        ((c = b.attr("href")),
        (c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, "")));
      var d = c && a(c);
      return d && d.length ? d : b.parent();
    }
    function c(c) {
      (c && 3 === c.which) ||
        (a(e).remove(),
        a(f).each(function () {
          var d = a(this),
            e = b(d),
            f = { relatedTarget: this };
          e.hasClass("open") &&
            ((c &&
              "click" == c.type &&
              /input|textarea/i.test(c.target.tagName) &&
              a.contains(e[0], c.target)) ||
              (e.trigger((c = a.Event("hide.bs.dropdown", f))),
              c.isDefaultPrevented() ||
                (d.attr("aria-expanded", "false"),
                e.removeClass("open").trigger("hidden.bs.dropdown", f))));
        }));
    }
    function d(b) {
      return this.each(function () {
        var c = a(this),
          d = c.data("bs.dropdown");
        d || c.data("bs.dropdown", (d = new g(this))),
          "string" == typeof b && d[b].call(c);
      });
    }
    var e = ".dropdown-backdrop",
      f = '[data-toggle="dropdown"]',
      g = function (b) {
        a(b).on("click.bs.dropdown", this.toggle);
      };
    (g.VERSION = "3.3.5"),
      (g.prototype.toggle = function (d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
          var f = b(e),
            g = f.hasClass("open");
          if ((c(), !g)) {
            "ontouchstart" in document.documentElement &&
              !f.closest(".navbar-nav").length &&
              a(document.createElement("div"))
                .addClass("dropdown-backdrop")
                .insertAfter(a(this))
                .on("click", c);
            var h = { relatedTarget: this };
            if (
              (f.trigger((d = a.Event("show.bs.dropdown", h))),
              d.isDefaultPrevented())
            )
              return;
            e.trigger("focus").attr("aria-expanded", "true"),
              f.toggleClass("open").trigger("shown.bs.dropdown", h);
          }
          return !1;
        }
      }),
      (g.prototype.keydown = function (c) {
        if (
          /(38|40|27|32)/.test(c.which) &&
          !/input|textarea/i.test(c.target.tagName)
        ) {
          var d = a(this);
          if (
            (c.preventDefault(),
            c.stopPropagation(),
            !d.is(".disabled, :disabled"))
          ) {
            var e = b(d),
              g = e.hasClass("open");
            if ((!g && 27 != c.which) || (g && 27 == c.which))
              return (
                27 == c.which && e.find(f).trigger("focus"), d.trigger("click")
              );
            var h = " li:not(.disabled):visible a",
              i = e.find(".dropdown-menu" + h);
            if (i.length) {
              var j = i.index(c.target);
              38 == c.which && j > 0 && j--,
                40 == c.which && j < i.length - 1 && j++,
                ~j || (j = 0),
                i.eq(j).trigger("focus");
            }
          }
        }
      });
    var h = a.fn.dropdown;
    (a.fn.dropdown = d),
      (a.fn.dropdown.Constructor = g),
      (a.fn.dropdown.noConflict = function () {
        return (a.fn.dropdown = h), this;
      }),
      a(document)
        .on("click.bs.dropdown.data-api", c)
        .on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
          a.stopPropagation();
        })
        .on("click.bs.dropdown.data-api", f, g.prototype.toggle)
        .on("keydown.bs.dropdown.data-api", f, g.prototype.keydown)
        .on(
          "keydown.bs.dropdown.data-api",
          ".dropdown-menu",
          g.prototype.keydown
        );
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b, d) {
      return this.each(function () {
        var e = a(this),
          f = e.data("bs.modal"),
          g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
        f || e.data("bs.modal", (f = new c(this, g))),
          "string" == typeof b ? f[b](d) : g.show && f.show(d);
      });
    }
    var c = function (b, c) {
      (this.options = c),
        (this.$body = a(document.body)),
        (this.$element = a(b)),
        (this.$dialog = this.$element.find(".modal-dialog")),
        (this.$backdrop = null),
        (this.isShown = null),
        (this.originalBodyPad = null),
        (this.scrollbarWidth = 0),
        (this.ignoreBackdropClick = !1),
        this.options.remote &&
          this.$element.find(".modal-content").load(
            this.options.remote,
            a.proxy(function () {
              this.$element.trigger("loaded.bs.modal");
            }, this)
          );
    };
    (c.VERSION = "3.3.5"),
      (c.TRANSITION_DURATION = 300),
      (c.BACKDROP_TRANSITION_DURATION = 150),
      (c.DEFAULTS = { backdrop: !0, keyboard: !0, show: !0 }),
      (c.prototype.toggle = function (a) {
        return this.isShown ? this.hide() : this.show(a);
      }),
      (c.prototype.show = function (b) {
        var d = this,
          e = a.Event("show.bs.modal", { relatedTarget: b });
        this.$element.trigger(e),
          this.isShown ||
            e.isDefaultPrevented() ||
            ((this.isShown = !0),
            this.checkScrollbar(),
            this.setScrollbar(),
            this.$body.addClass("modal-open"),
            this.escape(),
            this.resize(),
            this.$element.on(
              "click.dismiss.bs.modal",
              '[data-dismiss="modal"]',
              a.proxy(this.hide, this)
            ),
            this.$dialog.on("mousedown.dismiss.bs.modal", function () {
              d.$element.one("mouseup.dismiss.bs.modal", function (b) {
                a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0);
              });
            }),
            this.backdrop(function () {
              var e = a.support.transition && d.$element.hasClass("fade");
              d.$element.parent().length || d.$element.appendTo(d.$body),
                d.$element.show().scrollTop(0),
                d.adjustDialog(),
                e && d.$element[0].offsetWidth,
                d.$element.addClass("in"),
                d.enforceFocus();
              var f = a.Event("shown.bs.modal", { relatedTarget: b });
              e
                ? d.$dialog
                    .one("bsTransitionEnd", function () {
                      d.$element.trigger("focus").trigger(f);
                    })
                    .emulateTransitionEnd(c.TRANSITION_DURATION)
                : d.$element.trigger("focus").trigger(f);
            }));
      }),
      (c.prototype.hide = function (b) {
        b && b.preventDefault(),
          (b = a.Event("hide.bs.modal")),
          this.$element.trigger(b),
          this.isShown &&
            !b.isDefaultPrevented() &&
            ((this.isShown = !1),
            this.escape(),
            this.resize(),
            a(document).off("focusin.bs.modal"),
            this.$element
              .removeClass("in")
              .off("click.dismiss.bs.modal")
              .off("mouseup.dismiss.bs.modal"),
            this.$dialog.off("mousedown.dismiss.bs.modal"),
            a.support.transition && this.$element.hasClass("fade")
              ? this.$element
                  .one("bsTransitionEnd", a.proxy(this.hideModal, this))
                  .emulateTransitionEnd(c.TRANSITION_DURATION)
              : this.hideModal());
      }),
      (c.prototype.enforceFocus = function () {
        a(document)
          .off("focusin.bs.modal")
          .on(
            "focusin.bs.modal",
            a.proxy(function (a) {
              this.$element[0] === a.target ||
                this.$element.has(a.target).length ||
                this.$element.trigger("focus");
            }, this)
          );
      }),
      (c.prototype.escape = function () {
        this.isShown && this.options.keyboard
          ? this.$element.on(
              "keydown.dismiss.bs.modal",
              a.proxy(function (a) {
                27 == a.which && this.hide();
              }, this)
            )
          : this.isShown || this.$element.off("keydown.dismiss.bs.modal");
      }),
      (c.prototype.resize = function () {
        this.isShown
          ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this))
          : a(window).off("resize.bs.modal");
      }),
      (c.prototype.hideModal = function () {
        var a = this;
        this.$element.hide(),
          this.backdrop(function () {
            a.$body.removeClass("modal-open"),
              a.resetAdjustments(),
              a.resetScrollbar(),
              a.$element.trigger("hidden.bs.modal");
          });
      }),
      (c.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), (this.$backdrop = null);
      }),
      (c.prototype.backdrop = function (b) {
        var d = this,
          e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
          var f = a.support.transition && e;
          if (
            ((this.$backdrop = a(document.createElement("div"))
              .addClass("modal-backdrop " + e)
              .appendTo(this.$body)),
            this.$element.on(
              "click.dismiss.bs.modal",
              a.proxy(function (a) {
                return this.ignoreBackdropClick
                  ? void (this.ignoreBackdropClick = !1)
                  : void (
                      a.target === a.currentTarget &&
                      ("static" == this.options.backdrop
                        ? this.$element[0].focus()
                        : this.hide())
                    );
              }, this)
            ),
            f && this.$backdrop[0].offsetWidth,
            this.$backdrop.addClass("in"),
            !b)
          )
            return;
          f
            ? this.$backdrop
                .one("bsTransitionEnd", b)
                .emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION)
            : b();
        } else if (!this.isShown && this.$backdrop) {
          this.$backdrop.removeClass("in");
          var g = function () {
            d.removeBackdrop(), b && b();
          };
          a.support.transition && this.$element.hasClass("fade")
            ? this.$backdrop
                .one("bsTransitionEnd", g)
                .emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION)
            : g();
        } else b && b();
      }),
      (c.prototype.handleUpdate = function () {
        this.adjustDialog();
      }),
      (c.prototype.adjustDialog = function () {
        var a =
          this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
          paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
          paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : "",
        });
      }),
      (c.prototype.resetAdjustments = function () {
        this.$element.css({ paddingLeft: "", paddingRight: "" });
      }),
      (c.prototype.checkScrollbar = function () {
        var a = window.innerWidth;
        if (!a) {
          var b = document.documentElement.getBoundingClientRect();
          a = b.right - Math.abs(b.left);
        }
        (this.bodyIsOverflowing = document.body.clientWidth < a),
          (this.scrollbarWidth = this.measureScrollbar());
      }),
      (c.prototype.setScrollbar = function () {
        var a = parseInt(this.$body.css("padding-right") || 0, 10);
        (this.originalBodyPad = document.body.style.paddingRight || ""),
          this.bodyIsOverflowing &&
            this.$body.css("padding-right", a + this.scrollbarWidth);
      }),
      (c.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad);
      }),
      (c.prototype.measureScrollbar = function () {
        var a = document.createElement("div");
        (a.className = "modal-scrollbar-measure"), this.$body.append(a);
        var b = a.offsetWidth - a.clientWidth;
        return this.$body[0].removeChild(a), b;
      });
    var d = a.fn.modal;
    (a.fn.modal = b),
      (a.fn.modal.Constructor = c),
      (a.fn.modal.noConflict = function () {
        return (a.fn.modal = d), this;
      }),
      a(document).on(
        "click.bs.modal.data-api",
        '[data-toggle="modal"]',
        function (c) {
          var d = a(this),
            e = d.attr("href"),
            f = a(
              d.attr("data-target") || (e && e.replace(/.*(?=#[^\s]+$)/, ""))
            ),
            g = f.data("bs.modal")
              ? "toggle"
              : a.extend({ remote: !/#/.test(e) && e }, f.data(), d.data());
          d.is("a") && c.preventDefault(),
            f.one("show.bs.modal", function (a) {
              a.isDefaultPrevented() ||
                f.one("hidden.bs.modal", function () {
                  d.is(":visible") && d.trigger("focus");
                });
            }),
            b.call(f, g, this);
        }
      );
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.tooltip"),
          f = "object" == typeof b && b;
        (e || !/destroy|hide/.test(b)) &&
          (e || d.data("bs.tooltip", (e = new c(this, f))),
          "string" == typeof b && e[b]());
      });
    }
    var c = function (a, b) {
      (this.type = null),
        (this.options = null),
        (this.enabled = null),
        (this.timeout = null),
        (this.hoverState = null),
        (this.$element = null),
        (this.inState = null),
        this.init("tooltip", a, b);
    };
    (c.VERSION = "3.3.5"),
      (c.TRANSITION_DURATION = 150),
      (c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template:
          '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: { selector: "body", padding: 0 },
      }),
      (c.prototype.init = function (b, c, d) {
        if (
          ((this.enabled = !0),
          (this.type = b),
          (this.$element = a(c)),
          (this.options = this.getOptions(d)),
          (this.$viewport =
            this.options.viewport &&
            a(
              a.isFunction(this.options.viewport)
                ? this.options.viewport.call(this, this.$element)
                : this.options.viewport.selector || this.options.viewport
            )),
          (this.inState = { click: !1, hover: !1, focus: !1 }),
          this.$element[0] instanceof document.constructor &&
            !this.options.selector)
        )
          throw new Error(
            "`selector` option must be specified when initializing " +
              this.type +
              " on the window.document object!"
          );
        for (var e = this.options.trigger.split(" "), f = e.length; f--; ) {
          var g = e[f];
          if ("click" == g)
            this.$element.on(
              "click." + this.type,
              this.options.selector,
              a.proxy(this.toggle, this)
            );
          else if ("manual" != g) {
            var h = "hover" == g ? "mouseenter" : "focusin",
              i = "hover" == g ? "mouseleave" : "focusout";
            this.$element.on(
              h + "." + this.type,
              this.options.selector,
              a.proxy(this.enter, this)
            ),
              this.$element.on(
                i + "." + this.type,
                this.options.selector,
                a.proxy(this.leave, this)
              );
          }
        }
        this.options.selector
          ? (this._options = a.extend({}, this.options, {
              trigger: "manual",
              selector: "",
            }))
          : this.fixTitle();
      }),
      (c.prototype.getDefaults = function () {
        return c.DEFAULTS;
      }),
      (c.prototype.getOptions = function (b) {
        return (
          (b = a.extend({}, this.getDefaults(), this.$element.data(), b)),
          b.delay &&
            "number" == typeof b.delay &&
            (b.delay = { show: b.delay, hide: b.delay }),
          b
        );
      }),
      (c.prototype.getDelegateOptions = function () {
        var b = {},
          c = this.getDefaults();
        return (
          this._options &&
            a.each(this._options, function (a, d) {
              c[a] != d && (b[a] = d);
            }),
          b
        );
      }),
      (c.prototype.enter = function (b) {
        var c =
          b instanceof this.constructor
            ? b
            : a(b.currentTarget).data("bs." + this.type);
        return (
          c ||
            ((c = new this.constructor(
              b.currentTarget,
              this.getDelegateOptions()
            )),
            a(b.currentTarget).data("bs." + this.type, c)),
          b instanceof a.Event &&
            (c.inState["focusin" == b.type ? "focus" : "hover"] = !0),
          c.tip().hasClass("in") || "in" == c.hoverState
            ? void (c.hoverState = "in")
            : (clearTimeout(c.timeout),
              (c.hoverState = "in"),
              c.options.delay && c.options.delay.show
                ? void (c.timeout = setTimeout(function () {
                    "in" == c.hoverState && c.show();
                  }, c.options.delay.show))
                : c.show())
        );
      }),
      (c.prototype.isInStateTrue = function () {
        for (var a in this.inState) if (this.inState[a]) return !0;
        return !1;
      }),
      (c.prototype.leave = function (b) {
        var c =
          b instanceof this.constructor
            ? b
            : a(b.currentTarget).data("bs." + this.type);
        return (
          c ||
            ((c = new this.constructor(
              b.currentTarget,
              this.getDelegateOptions()
            )),
            a(b.currentTarget).data("bs." + this.type, c)),
          b instanceof a.Event &&
            (c.inState["focusout" == b.type ? "focus" : "hover"] = !1),
          c.isInStateTrue()
            ? void 0
            : (clearTimeout(c.timeout),
              (c.hoverState = "out"),
              c.options.delay && c.options.delay.hide
                ? void (c.timeout = setTimeout(function () {
                    "out" == c.hoverState && c.hide();
                  }, c.options.delay.hide))
                : c.hide())
        );
      }),
      (c.prototype.show = function () {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
          this.$element.trigger(b);
          var d = a.contains(
            this.$element[0].ownerDocument.documentElement,
            this.$element[0]
          );
          if (b.isDefaultPrevented() || !d) return;
          var e = this,
            f = this.tip(),
            g = this.getUID(this.type);
          this.setContent(),
            f.attr("id", g),
            this.$element.attr("aria-describedby", g),
            this.options.animation && f.addClass("fade");
          var h =
              "function" == typeof this.options.placement
                ? this.options.placement.call(this, f[0], this.$element[0])
                : this.options.placement,
            i = /\s?auto?\s?/i,
            j = i.test(h);
          j && (h = h.replace(i, "") || "top"),
            f
              .detach()
              .css({ top: 0, left: 0, display: "block" })
              .addClass(h)
              .data("bs." + this.type, this),
            this.options.container
              ? f.appendTo(this.options.container)
              : f.insertAfter(this.$element),
            this.$element.trigger("inserted.bs." + this.type);
          var k = this.getPosition(),
            l = f[0].offsetWidth,
            m = f[0].offsetHeight;
          if (j) {
            var n = h,
              o = this.getPosition(this.$viewport);
            (h =
              "bottom" == h && k.bottom + m > o.bottom
                ? "top"
                : "top" == h && k.top - m < o.top
                ? "bottom"
                : "right" == h && k.right + l > o.width
                ? "left"
                : "left" == h && k.left - l < o.left
                ? "right"
                : h),
              f.removeClass(n).addClass(h);
          }
          var p = this.getCalculatedOffset(h, k, l, m);
          this.applyPlacement(p, h);
          var q = function () {
            var a = e.hoverState;
            e.$element.trigger("shown.bs." + e.type),
              (e.hoverState = null),
              "out" == a && e.leave(e);
          };
          a.support.transition && this.$tip.hasClass("fade")
            ? f
                .one("bsTransitionEnd", q)
                .emulateTransitionEnd(c.TRANSITION_DURATION)
            : q();
        }
      }),
      (c.prototype.applyPlacement = function (b, c) {
        var d = this.tip(),
          e = d[0].offsetWidth,
          f = d[0].offsetHeight,
          g = parseInt(d.css("margin-top"), 10),
          h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0),
          isNaN(h) && (h = 0),
          (b.top += g),
          (b.left += h),
          a.offset.setOffset(
            d[0],
            a.extend(
              {
                using: function (a) {
                  d.css({ top: Math.round(a.top), left: Math.round(a.left) });
                },
              },
              b
            ),
            0
          ),
          d.addClass("in");
        var i = d[0].offsetWidth,
          j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? (b.left += k.left) : (b.top += k.top);
        var l = /top|bottom/.test(c),
          m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
          n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l);
      }),
      (c.prototype.replaceArrow = function (a, b, c) {
        this.arrow()
          .css(c ? "left" : "top", 50 * (1 - a / b) + "%")
          .css(c ? "top" : "left", "");
      }),
      (c.prototype.setContent = function () {
        var a = this.tip(),
          b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b),
          a.removeClass("fade in top bottom left right");
      }),
      (c.prototype.hide = function (b) {
        function d() {
          "in" != e.hoverState && f.detach(),
            e.$element
              .removeAttr("aria-describedby")
              .trigger("hidden.bs." + e.type),
            b && b();
        }
        var e = this,
          f = a(this.$tip),
          g = a.Event("hide.bs." + this.type);
        return (
          this.$element.trigger(g),
          g.isDefaultPrevented()
            ? void 0
            : (f.removeClass("in"),
              a.support.transition && f.hasClass("fade")
                ? f
                    .one("bsTransitionEnd", d)
                    .emulateTransitionEnd(c.TRANSITION_DURATION)
                : d(),
              (this.hoverState = null),
              this)
        );
      }),
      (c.prototype.fixTitle = function () {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) &&
          a
            .attr("data-original-title", a.attr("title") || "")
            .attr("title", "");
      }),
      (c.prototype.hasContent = function () {
        return this.getTitle();
      }),
      (c.prototype.getPosition = function (b) {
        b = b || this.$element;
        var c = b[0],
          d = "BODY" == c.tagName,
          e = c.getBoundingClientRect();
        null == e.width &&
          (e = a.extend({}, e, {
            width: e.right - e.left,
            height: e.bottom - e.top,
          }));
        var f = d ? { top: 0, left: 0 } : b.offset(),
          g = {
            scroll: d
              ? document.documentElement.scrollTop || document.body.scrollTop
              : b.scrollTop(),
          },
          h = d
            ? { width: a(window).width(), height: a(window).height() }
            : null;
        return a.extend({}, e, g, h, f);
      }),
      (c.prototype.getCalculatedOffset = function (a, b, c, d) {
        return "bottom" == a
          ? { top: b.top + b.height, left: b.left + b.width / 2 - c / 2 }
          : "top" == a
          ? { top: b.top - d, left: b.left + b.width / 2 - c / 2 }
          : "left" == a
          ? { top: b.top + b.height / 2 - d / 2, left: b.left - c }
          : { top: b.top + b.height / 2 - d / 2, left: b.left + b.width };
      }),
      (c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
        var e = { top: 0, left: 0 };
        if (!this.$viewport) return e;
        var f = (this.options.viewport && this.options.viewport.padding) || 0,
          g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
          var h = b.top - f - g.scroll,
            i = b.top + f - g.scroll + d;
          h < g.top
            ? (e.top = g.top - h)
            : i > g.top + g.height && (e.top = g.top + g.height - i);
        } else {
          var j = b.left - f,
            k = b.left + f + c;
          j < g.left
            ? (e.left = g.left - j)
            : k > g.right && (e.left = g.left + g.width - k);
        }
        return e;
      }),
      (c.prototype.getTitle = function () {
        var a,
          b = this.$element,
          c = this.options;
        return (a =
          b.attr("data-original-title") ||
          ("function" == typeof c.title ? c.title.call(b[0]) : c.title));
      }),
      (c.prototype.getUID = function (a) {
        do a += ~~(1e6 * Math.random());
        while (document.getElementById(a));
        return a;
      }),
      (c.prototype.tip = function () {
        if (
          !this.$tip &&
          ((this.$tip = a(this.options.template)), 1 != this.$tip.length)
        )
          throw new Error(
            this.type +
              " `template` option must consist of exactly 1 top-level element!"
          );
        return this.$tip;
      }),
      (c.prototype.arrow = function () {
        return (this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow"));
      }),
      (c.prototype.enable = function () {
        this.enabled = !0;
      }),
      (c.prototype.disable = function () {
        this.enabled = !1;
      }),
      (c.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled;
      }),
      (c.prototype.toggle = function (b) {
        var c = this;
        b &&
          ((c = a(b.currentTarget).data("bs." + this.type)),
          c ||
            ((c = new this.constructor(
              b.currentTarget,
              this.getDelegateOptions()
            )),
            a(b.currentTarget).data("bs." + this.type, c))),
          b
            ? ((c.inState.click = !c.inState.click),
              c.isInStateTrue() ? c.enter(c) : c.leave(c))
            : c.tip().hasClass("in")
            ? c.leave(c)
            : c.enter(c);
      }),
      (c.prototype.destroy = function () {
        var a = this;
        clearTimeout(this.timeout),
          this.hide(function () {
            a.$element.off("." + a.type).removeData("bs." + a.type),
              a.$tip && a.$tip.detach(),
              (a.$tip = null),
              (a.$arrow = null),
              (a.$viewport = null);
          });
      });
    var d = a.fn.tooltip;
    (a.fn.tooltip = b),
      (a.fn.tooltip.Constructor = c),
      (a.fn.tooltip.noConflict = function () {
        return (a.fn.tooltip = d), this;
      });
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.popover"),
          f = "object" == typeof b && b;
        (e || !/destroy|hide/.test(b)) &&
          (e || d.data("bs.popover", (e = new c(this, f))),
          "string" == typeof b && e[b]());
      });
    }
    var c = function (a, b) {
      this.init("popover", a, b);
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    (c.VERSION = "3.3.5"),
      (c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template:
          '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
      })),
      (c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype)),
      (c.prototype.constructor = c),
      (c.prototype.getDefaults = function () {
        return c.DEFAULTS;
      }),
      (c.prototype.setContent = function () {
        var a = this.tip(),
          b = this.getTitle(),
          c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b),
          a
            .find(".popover-content")
            .children()
            .detach()
            .end()
            [
              this.options.html
                ? "string" == typeof c
                  ? "html"
                  : "append"
                : "text"
            ](c),
          a.removeClass("fade top bottom left right in"),
          a.find(".popover-title").html() || a.find(".popover-title").hide();
      }),
      (c.prototype.hasContent = function () {
        return this.getTitle() || this.getContent();
      }),
      (c.prototype.getContent = function () {
        var a = this.$element,
          b = this.options;
        return (
          a.attr("data-content") ||
          ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
        );
      }),
      (c.prototype.arrow = function () {
        return (this.$arrow = this.$arrow || this.tip().find(".arrow"));
      });
    var d = a.fn.popover;
    (a.fn.popover = b),
      (a.fn.popover.Constructor = c),
      (a.fn.popover.noConflict = function () {
        return (a.fn.popover = d), this;
      });
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(c, d) {
      (this.$body = a(document.body)),
        (this.$scrollElement = a(a(c).is(document.body) ? window : c)),
        (this.options = a.extend({}, b.DEFAULTS, d)),
        (this.selector = (this.options.target || "") + " .nav li > a"),
        (this.offsets = []),
        (this.targets = []),
        (this.activeTarget = null),
        (this.scrollHeight = 0),
        this.$scrollElement.on(
          "scroll.bs.scrollspy",
          a.proxy(this.process, this)
        ),
        this.refresh(),
        this.process();
    }
    function c(c) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.scrollspy"),
          f = "object" == typeof c && c;
        e || d.data("bs.scrollspy", (e = new b(this, f))),
          "string" == typeof c && e[c]();
      });
    }
    (b.VERSION = "3.3.5"),
      (b.DEFAULTS = { offset: 10 }),
      (b.prototype.getScrollHeight = function () {
        return (
          this.$scrollElement[0].scrollHeight ||
          Math.max(
            this.$body[0].scrollHeight,
            document.documentElement.scrollHeight
          )
        );
      }),
      (b.prototype.refresh = function () {
        var b = this,
          c = "offset",
          d = 0;
        (this.offsets = []),
          (this.targets = []),
          (this.scrollHeight = this.getScrollHeight()),
          a.isWindow(this.$scrollElement[0]) ||
            ((c = "position"), (d = this.$scrollElement.scrollTop())),
          this.$body
            .find(this.selector)
            .map(function () {
              var b = a(this),
                e = b.data("target") || b.attr("href"),
                f = /^#./.test(e) && a(e);
              return (
                (f && f.length && f.is(":visible") && [[f[c]().top + d, e]]) ||
                null
              );
            })
            .sort(function (a, b) {
              return a[0] - b[0];
            })
            .each(function () {
              b.offsets.push(this[0]), b.targets.push(this[1]);
            });
      }),
      (b.prototype.process = function () {
        var a,
          b = this.$scrollElement.scrollTop() + this.options.offset,
          c = this.getScrollHeight(),
          d = this.options.offset + c - this.$scrollElement.height(),
          e = this.offsets,
          f = this.targets,
          g = this.activeTarget;
        if ((this.scrollHeight != c && this.refresh(), b >= d))
          return g != (a = f[f.length - 1]) && this.activate(a);
        if (g && b < e[0]) return (this.activeTarget = null), this.clear();
        for (a = e.length; a--; )
          g != f[a] &&
            b >= e[a] &&
            (void 0 === e[a + 1] || b < e[a + 1]) &&
            this.activate(f[a]);
      }),
      (b.prototype.activate = function (b) {
        (this.activeTarget = b), this.clear();
        var c =
            this.selector +
            '[data-target="' +
            b +
            '"],' +
            this.selector +
            '[href="' +
            b +
            '"]',
          d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length &&
          (d = d.closest("li.dropdown").addClass("active")),
          d.trigger("activate.bs.scrollspy");
      }),
      (b.prototype.clear = function () {
        a(this.selector)
          .parentsUntil(this.options.target, ".active")
          .removeClass("active");
      });
    var d = a.fn.scrollspy;
    (a.fn.scrollspy = c),
      (a.fn.scrollspy.Constructor = b),
      (a.fn.scrollspy.noConflict = function () {
        return (a.fn.scrollspy = d), this;
      }),
      a(window).on("load.bs.scrollspy.data-api", function () {
        a('[data-spy="scroll"]').each(function () {
          var b = a(this);
          c.call(b, b.data());
        });
      });
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.tab");
        e || d.data("bs.tab", (e = new c(this))),
          "string" == typeof b && e[b]();
      });
    }
    var c = function (b) {
      this.element = a(b);
    };
    (c.VERSION = "3.3.5"),
      (c.TRANSITION_DURATION = 150),
      (c.prototype.show = function () {
        var b = this.element,
          c = b.closest("ul:not(.dropdown-menu)"),
          d = b.data("target");
        if (
          (d ||
            ((d = b.attr("href")), (d = d && d.replace(/.*(?=#[^\s]*$)/, ""))),
          !b.parent("li").hasClass("active"))
        ) {
          var e = c.find(".active:last a"),
            f = a.Event("hide.bs.tab", { relatedTarget: b[0] }),
            g = a.Event("show.bs.tab", { relatedTarget: e[0] });
          if (
            (e.trigger(f),
            b.trigger(g),
            !g.isDefaultPrevented() && !f.isDefaultPrevented())
          ) {
            var h = a(d);
            this.activate(b.closest("li"), c),
              this.activate(h, h.parent(), function () {
                e.trigger({ type: "hidden.bs.tab", relatedTarget: b[0] }),
                  b.trigger({ type: "shown.bs.tab", relatedTarget: e[0] });
              });
          }
        }
      }),
      (c.prototype.activate = function (b, d, e) {
        function f() {
          g
            .removeClass("active")
            .find("> .dropdown-menu > .active")
            .removeClass("active")
            .end()
            .find('[data-toggle="tab"]')
            .attr("aria-expanded", !1),
            b
              .addClass("active")
              .find('[data-toggle="tab"]')
              .attr("aria-expanded", !0),
            h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"),
            b.parent(".dropdown-menu").length &&
              b
                .closest("li.dropdown")
                .addClass("active")
                .end()
                .find('[data-toggle="tab"]')
                .attr("aria-expanded", !0),
            e && e();
        }
        var g = d.find("> .active"),
          h =
            e &&
            a.support.transition &&
            ((g.length && g.hasClass("fade")) || !!d.find("> .fade").length);
        g.length && h
          ? g
              .one("bsTransitionEnd", f)
              .emulateTransitionEnd(c.TRANSITION_DURATION)
          : f(),
          g.removeClass("in");
      });
    var d = a.fn.tab;
    (a.fn.tab = b),
      (a.fn.tab.Constructor = c),
      (a.fn.tab.noConflict = function () {
        return (a.fn.tab = d), this;
      });
    var e = function (c) {
      c.preventDefault(), b.call(a(this), "show");
    };
    a(document)
      .on("click.bs.tab.data-api", '[data-toggle="tab"]', e)
      .on("click.bs.tab.data-api", '[data-toggle="pill"]', e);
  })(jQuery),
  +(function (a) {
    "use strict";
    function b(b) {
      return this.each(function () {
        var d = a(this),
          e = d.data("bs.affix"),
          f = "object" == typeof b && b;
        e || d.data("bs.affix", (e = new c(this, f))),
          "string" == typeof b && e[b]();
      });
    }
    var c = function (b, d) {
      (this.options = a.extend({}, c.DEFAULTS, d)),
        (this.$target = a(this.options.target)
          .on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this))
          .on(
            "click.bs.affix.data-api",
            a.proxy(this.checkPositionWithEventLoop, this)
          )),
        (this.$element = a(b)),
        (this.affixed = null),
        (this.unpin = null),
        (this.pinnedOffset = null),
        this.checkPosition();
    };
    (c.VERSION = "3.3.5"),
      (c.RESET = "affix affix-top affix-bottom"),
      (c.DEFAULTS = { offset: 0, target: window }),
      (c.prototype.getState = function (a, b, c, d) {
        var e = this.$target.scrollTop(),
          f = this.$element.offset(),
          g = this.$target.height();
        if (null != c && "top" == this.affixed) return c > e ? "top" : !1;
        if ("bottom" == this.affixed)
          return null != c
            ? e + this.unpin <= f.top
              ? !1
              : "bottom"
            : a - d >= e + g
            ? !1
            : "bottom";
        var h = null == this.affixed,
          i = h ? e : f.top,
          j = h ? g : b;
        return null != c && c >= e
          ? "top"
          : null != d && i + j >= a - d
          ? "bottom"
          : !1;
      }),
      (c.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(c.RESET).addClass("affix");
        var a = this.$target.scrollTop(),
          b = this.$element.offset();
        return (this.pinnedOffset = b.top - a);
      }),
      (c.prototype.checkPositionWithEventLoop = function () {
        setTimeout(a.proxy(this.checkPosition, this), 1);
      }),
      (c.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
          var b = this.$element.height(),
            d = this.options.offset,
            e = d.top,
            f = d.bottom,
            g = Math.max(a(document).height(), a(document.body).height());
          "object" != typeof d && (f = e = d),
            "function" == typeof e && (e = d.top(this.$element)),
            "function" == typeof f && (f = d.bottom(this.$element));
          var h = this.getState(g, b, e, f);
          if (this.affixed != h) {
            null != this.unpin && this.$element.css("top", "");
            var i = "affix" + (h ? "-" + h : ""),
              j = a.Event(i + ".bs.affix");
            if ((this.$element.trigger(j), j.isDefaultPrevented())) return;
            (this.affixed = h),
              (this.unpin = "bottom" == h ? this.getPinnedOffset() : null),
              this.$element
                .removeClass(c.RESET)
                .addClass(i)
                .trigger(i.replace("affix", "affixed") + ".bs.affix");
          }
          "bottom" == h && this.$element.offset({ top: g - b - f });
        }
      });
    var d = a.fn.affix;
    (a.fn.affix = b),
      (a.fn.affix.Constructor = c),
      (a.fn.affix.noConflict = function () {
        return (a.fn.affix = d), this;
      }),
      a(window).on("load", function () {
        a('[data-spy="affix"]').each(function () {
          var c = a(this),
            d = c.data();
          (d.offset = d.offset || {}),
            null != d.offsetBottom && (d.offset.bottom = d.offsetBottom),
            null != d.offsetTop && (d.offset.top = d.offsetTop),
            b.call(c, d);
        });
      });
  })(jQuery);

/*!
  hey, [be]Lazy.js - v1.8.2 - 2016.10.25
  A fast, small and dependency free lazy load script (https://github.com/dinbror/blazy)
  (c) Bjoern Klinggaard - @bklinggaard - http://dinbror.dk/blazy
*/
(function (q, m) {
  "function" === typeof define && define.amd
    ? define(m)
    : "object" === typeof exports
    ? (module.exports = m())
    : (q.Blazy = m());
})(this, function () {
  function q(b) {
    var c = b._util;
    c.elements = E(b.options);
    c.count = c.elements.length;
    c.destroyed &&
      ((c.destroyed = !1),
      b.options.container &&
        l(b.options.container, function (a) {
          n(a, "scroll", c.validateT);
        }),
      n(window, "resize", c.saveViewportOffsetT),
      n(window, "resize", c.validateT),
      n(window, "scroll", c.validateT));
    m(b);
  }
  function m(b) {
    for (var c = b._util, a = 0; a < c.count; a++) {
      var d = c.elements[a],
        e;
      a: {
        var g = d;
        e = b.options;
        var p = g.getBoundingClientRect();
        if (e.container && y && (g = g.closest(e.containerClass))) {
          g = g.getBoundingClientRect();
          e = r(g, f)
            ? r(p, {
                top: g.top - e.offset,
                right: g.right + e.offset,
                bottom: g.bottom + e.offset,
                left: g.left - e.offset,
              })
            : !1;
          break a;
        }
        e = r(p, f);
      }
      if (e || t(d, b.options.successClass))
        b.load(d), c.elements.splice(a, 1), c.count--, a--;
    }
    0 === c.count && b.destroy();
  }
  function r(b, c) {
    return (
      b.right >= c.left &&
      b.bottom >= c.top &&
      b.left <= c.right &&
      b.top <= c.bottom
    );
  }
  function z(b, c, a) {
    if (
      !t(b, a.successClass) &&
      (c || a.loadInvisible || (0 < b.offsetWidth && 0 < b.offsetHeight))
    )
      if ((c = b.getAttribute(u) || b.getAttribute(a.src))) {
        c = c.split(a.separator);
        var d = c[A && 1 < c.length ? 1 : 0],
          e = b.getAttribute(a.srcset),
          g = "img" === b.nodeName.toLowerCase(),
          p = (c = b.parentNode) && "picture" === c.nodeName.toLowerCase();
        if (g || void 0 === b.src) {
          var h = new Image(),
            w = function () {
              a.error && a.error(b, "invalid");
              v(b, a.errorClass);
              k(h, "error", w);
              k(h, "load", f);
            },
            f = function () {
              g
                ? p || B(b, d, e)
                : (b.style.backgroundImage = 'url("' + d + '")');
              x(b, a);
              k(h, "load", f);
              k(h, "error", w);
            };
          p &&
            ((h = b),
            l(c.getElementsByTagName("source"), function (b) {
              var c = a.srcset,
                e = b.getAttribute(c);
              e && (b.setAttribute("srcset", e), b.removeAttribute(c));
            }));
          n(h, "error", w);
          n(h, "load", f);
          B(h, d, e);
        } else (b.src = d), x(b, a);
      } else
        "video" === b.nodeName.toLowerCase()
          ? (l(b.getElementsByTagName("source"), function (b) {
              var c = a.src,
                e = b.getAttribute(c);
              e && (b.setAttribute("src", e), b.removeAttribute(c));
            }),
            b.load(),
            x(b, a))
          : (a.error && a.error(b, "missing"), v(b, a.errorClass));
  }
  function x(b, c) {
    v(b, c.successClass);
    c.success && c.success(b);
    b.removeAttribute(c.src);
    b.removeAttribute(c.srcset);
    l(c.breakpoints, function (a) {
      b.removeAttribute(a.src);
    });
  }
  function B(b, c, a) {
    a && b.setAttribute("srcset", a);
    b.src = c;
  }
  function t(b, c) {
    return -1 !== (" " + b.className + " ").indexOf(" " + c + " ");
  }
  function v(b, c) {
    t(b, c) || (b.className += " " + c);
  }
  function E(b) {
    var c = [];
    b = b.root.querySelectorAll(b.selector);
    for (var a = b.length; a--; c.unshift(b[a]));
    return c;
  }
  function C(b) {
    f.bottom =
      (window.innerHeight || document.documentElement.clientHeight) + b;
    f.right = (window.innerWidth || document.documentElement.clientWidth) + b;
  }
  function n(b, c, a) {
    b.attachEvent
      ? b.attachEvent && b.attachEvent("on" + c, a)
      : b.addEventListener(c, a, { capture: !1, passive: !0 });
  }
  function k(b, c, a) {
    b.detachEvent
      ? b.detachEvent && b.detachEvent("on" + c, a)
      : b.removeEventListener(c, a, { capture: !1, passive: !0 });
  }
  function l(b, c) {
    if (b && c) for (var a = b.length, d = 0; d < a && !1 !== c(b[d], d); d++);
  }
  function D(b, c, a) {
    var d = 0;
    return function () {
      var e = +new Date();
      e - d < c || ((d = e), b.apply(a, arguments));
    };
  }
  var u, f, A, y;
  return function (b) {
    if (!document.querySelectorAll) {
      var c = document.createStyleSheet();
      document.querySelectorAll = function (a, b, d, h, f) {
        f = document.all;
        b = [];
        a = a.replace(/\[for\b/gi, "[htmlFor").split(",");
        for (d = a.length; d--; ) {
          c.addRule(a[d], "k:v");
          for (h = f.length; h--; ) f[h].currentStyle.k && b.push(f[h]);
          c.removeRule(0);
        }
        return b;
      };
    }
    var a = this,
      d = (a._util = {});
    d.elements = [];
    d.destroyed = !0;
    a.options = b || {};
    a.options.error = a.options.error || !1;
    a.options.offset = a.options.offset || 100;
    a.options.root = a.options.root || document;
    a.options.success = a.options.success || !1;
    a.options.selector = a.options.selector || ".b-lazy";
    a.options.separator = a.options.separator || "|";
    a.options.containerClass = a.options.container;
    a.options.container = a.options.containerClass
      ? document.querySelectorAll(a.options.containerClass)
      : !1;
    a.options.errorClass = a.options.errorClass || "b-error";
    a.options.breakpoints = a.options.breakpoints || !1;
    a.options.loadInvisible = a.options.loadInvisible || !1;
    a.options.successClass = a.options.successClass || "b-loaded";
    a.options.validateDelay = a.options.validateDelay || 25;
    a.options.saveViewportOffsetDelay = a.options.saveViewportOffsetDelay || 50;
    a.options.srcset = a.options.srcset || "data-srcset";
    a.options.src = u = a.options.src || "data-src";
    y = Element.prototype.closest;
    A = 1 < window.devicePixelRatio;
    f = {};
    f.top = 0 - a.options.offset;
    f.left = 0 - a.options.offset;
    a.revalidate = function () {
      q(a);
    };
    a.load = function (a, b) {
      var c = this.options;
      void 0 === a.length
        ? z(a, b, c)
        : l(a, function (a) {
            z(a, b, c);
          });
    };
    a.destroy = function () {
      var a = this._util;
      this.options.container &&
        l(this.options.container, function (b) {
          k(b, "scroll", a.validateT);
        });
      k(window, "scroll", a.validateT);
      k(window, "resize", a.validateT);
      k(window, "resize", a.saveViewportOffsetT);
      a.count = 0;
      a.elements.length = 0;
      a.destroyed = !0;
    };
    d.validateT = D(
      function () {
        m(a);
      },
      a.options.validateDelay,
      a
    );
    d.saveViewportOffsetT = D(
      function () {
        C(a.options.offset);
      },
      a.options.saveViewportOffsetDelay,
      a
    );
    C(a.options.offset);
    l(a.options.breakpoints, function (a) {
      if (a.width >= window.screen.width) return (u = a.src), !1;
    });
    setTimeout(function () {
      q(a);
    });
  };
});

var mr_firstSectionHeight,
  mr_nav,
  mr_fixedAt,
  mr_navOuterHeight,
  mr_floatingProjectSections,
  mr_navScrolled = !1,
  mr_navFixed = !1,
  mr_outOfSight = !1,
  mr_scrollTop = 0;
if (document.querySelector(".b-lazy")) var bLazy = new Blazy({ offset: 300 });
function updateNav() {
  var e = mr_scrollTop;
  if (e <= 0)
    return (
      mr_navFixed && ((mr_navFixed = !1), mr_nav.removeClass("fixed")),
      mr_outOfSight && ((mr_outOfSight = !1), mr_nav.removeClass("outOfSight")),
      void (
        mr_navScrolled &&
        ((mr_navScrolled = !1), mr_nav.removeClass("scrolled"))
      )
    );
  if (e > mr_navOuterHeight + mr_fixedAt) {
    if (!mr_navScrolled)
      return mr_nav.addClass("scrolled"), void (mr_navScrolled = !0);
  } else
    e > mr_navOuterHeight
      ? (mr_navFixed || (mr_nav.addClass("fixed"), (mr_navFixed = !0)),
        e > mr_navOuterHeight + 10
          ? mr_outOfSight ||
            (mr_nav.addClass("outOfSight"), (mr_outOfSight = !0))
          : mr_outOfSight &&
            ((mr_outOfSight = !1), mr_nav.removeClass("outOfSight")))
      : (mr_navFixed && ((mr_navFixed = !1), mr_nav.removeClass("fixed")),
        mr_outOfSight &&
          ((mr_outOfSight = !1), mr_nav.removeClass("outOfSight"))),
      mr_navScrolled && ((mr_navScrolled = !1), mr_nav.removeClass("scrolled"));
}
function capitaliseFirstLetter(e) {
  return e.charAt(0).toUpperCase() + e.slice(1);
}
function initializeMasonry() {
  $(".masonry").each(function () {
    var e = $(this).get(0),
      t = new Masonry(e, { itemSelector: ".masonry-item" });
    t.on("layoutComplete", function () {
      (mr_firstSectionHeight = $(
        ".main-container section:nth-of-type(1)"
      ).outerHeight(!0)),
        $(".filters.floating").length &&
          (setupFloatingProjectFilters(),
          updateFloatingFilters(),
          window.addEventListener("scroll", updateFloatingFilters, !1)),
        $(".masonry").addClass("fadeIn"),
        $(".masonry-loader").addClass("fadeOut"),
        $(".masonryFlyIn").length && masonryFlyIn();
    }),
      t.layout();
  });
}
function masonryFlyIn() {
  var e = $(".masonryFlyIn .masonry-item"),
    t = 0;
  e.each(function () {
    var e = $(this);
    setTimeout(function () {
      e.addClass("fadeIn");
    }, t),
      (t += 170);
  });
}
function setupFloatingProjectFilters() {
  (mr_floatingProjectSections = []),
    $(".filters.floating")
      .closest("section")
      .each(function () {
        var e = $(this);
        mr_floatingProjectSections.push({
          section: e.get(0),
          outerHeight: e.outerHeight(),
          elemTop: e.offset().top,
          elemBottom: e.offset().top + e.outerHeight(),
          filters: e.find(".filters.floating"),
          filersHeight: e.find(".filters.floating").outerHeight(!0),
        });
      });
}
function updateFloatingFilters() {
  for (var e = mr_floatingProjectSections.length; e--; ) {
    var t = mr_floatingProjectSections[e];
    t.elemTop < mr_scrollTop && void 0 === window.mr_variant
      ? (t.filters.css({ position: "fixed", top: "16px", bottom: "auto" }),
        mr_navScrolled &&
          t.filters.css({ transform: "translate3d(-50%,48px,0)" }),
        mr_scrollTop > t.elemBottom - 70 &&
          (t.filters.css({ position: "absolute", bottom: "16px", top: "auto" }),
          t.filters.css({ transform: "translate3d(-50%,0,0)" })))
      : t.filters.css({
          position: "absolute",
          transform: "translate3d(-50%,0,0)",
        });
  }
}
function prepareSignup(e) {
  var t,
    a = jQuery("<form />"),
    i = jQuery("<div />");
  return (
    jQuery(i).html(e.attr("srcdoc")),
    (t = jQuery(i).find("form").attr("action")),
    /list-manage\.com/.test(t) &&
      "//" == (t = t.replace("/post?", "/post-json?") + "&c=?").substr(0, 2) &&
      (t = "http:" + t),
    /createsend\.com/.test(t) && (t += "?callback=?"),
    a.attr("action", t),
    jQuery(i)
      .find("input, select, textarea")
      .not('input[type="submit"]')
      .each(function () {
        jQuery(this).clone().appendTo(a);
      }),
    a
  );
}
$(document).ready(function () {
  var e = $(this).scrollTop();
  $(document).scroll(function () {
    (e = $(this).scrollTop()) < 710
      ? ($("#btn-contact").css("background-color", "#000"),
        $("#btn-logo").css("background-color", "#000"))
      : e >= 710 && e < 2400
      ? ($("#btn-contact").css("background-color", "#F2B306"),
        $("#btn-logo").css("background-color", "#F2B306"))
      : e >= 2400 && e < 4e3
      ? ($("#btn-contact").css("background-color", "#008C00"),
        $("#btn-logo").css("background-color", "#008C00"))
      : e >= 4e3 && e < 6600
      ? ($("#btn-contact").css("background-color", "#000000"),
        $("#btn-logo").css("background-color", "#000000"))
      : ($("#btn-contact").css("background-color", "#F2B306"),
        $("#btn-logo").css("background-color", "#F2B306"));
  }),
    $(".unlockerprice").click(function () {
      return (
        $("#frm-contact").is(":hidden") && $("#btn-contact").trigger("click"),
        !1
      );
    });
}),
  $(document).ready(function () {
    "use strict";
    document.querySelector(".glider") &&
      new Glider(document.querySelector(".glider"), {
        slidesToScroll: 1,
        slidesToShow: 5,
        draggable: !0,
        dots: ".dots",
        arrows: { prev: ".glider-prev", next: ".glider-next" },
        responsive: [
          { breakpoint: 250, settings: { slidesToShow: 2, slidesToScroll: 1 } },
          { breakpoint: 550, settings: { slidesToShow: 3, slidesToScroll: 1 } },
          { breakpoint: 775, settings: { slidesToShow: 5, slidesToScroll: 1 } },
          {
            breakpoint: 1024,
            settings: { slidesToShow: 5, slidesToScroll: 1 },
          },
        ],
      });
    var e,
      t = $("a.inner-link");
    if (t.length) {
      t.each(function () {
        var e = $(this);
        "#" !== e.attr("href").charAt(0) && e.removeClass("inner-link");
      });
      var a = 0;
      $("body[data-smooth-scroll-offset]").length &&
        ((a = $("body").attr("data-smooth-scroll-offset")), (a *= 1)),
        smoothScroll.init({
          selector: ".inner-link",
          selectorHeader: null,
          speed: 750,
          easing: "easeInOutCubic",
          offset: a,
        });
    }
    if (
      (addEventListener(
        "scroll",
        function () {
          mr_scrollTop = window.pageYOffset;
        },
        !1
      ),
      $(".background-image-holder").each(function () {
        var e = $(this).children("img").attr("src");
        $(this).css("background", 'url("' + e + '")'),
          $(this).children("img").hide(),
          $(this).css("background-position", "initial");
      }),
      setTimeout(function () {
        $(".background-image-holder").each(function () {
          $(this).addClass("fadeIn");
        });
      }, 200),
      $('[data-toggle="tooltip"]').tooltip(),
      $("ul[data-bullet]").each(function () {
        var e = $(this).attr("data-bullet");
        $(this)
          .find("li")
          .prepend('<i class="' + e + '"></i>');
      }),
      $(".progress-bar").each(function () {
        $(this).css("width", $(this).attr("data-progress") + "%");
      }),
      $("nav").hasClass("fixed") || $("nav").hasClass("absolute")
        ? $("body").addClass("nav-is-overlay")
        : ($(".nav-container").css("min-height", $("nav").outerHeight(!0)),
          $(window).resize(function () {
            $(".nav-container").css("min-height", $("nav").outerHeight(!0));
          }),
          $(window).width() > 768 &&
            $(".parallax:nth-of-type(1) .background-image-holder").css(
              "top",
              -$("nav").outerHeight(!0)
            ),
          $(window).width() > 768 &&
            $("section.fullscreen:nth-of-type(1)").css(
              "height",
              $(window).height() - $("nav").outerHeight(!0)
            )),
      $("nav").hasClass("bg-dark") && $(".nav-container").addClass("bg-dark"),
      (mr_nav = $("body .nav-container nav:first")),
      (mr_navOuterHeight = $("body .nav-container nav:first").outerHeight()),
      (mr_fixedAt =
        void 0 !== mr_nav.attr("data-fixed-at")
          ? parseInt(mr_nav.attr("data-fixed-at").replace("px", ""))
          : parseInt($("section:nth-of-type(1)").outerHeight())),
      window.addEventListener("scroll", updateNav, !1),
      $(".menu > li > ul").each(function () {
        var e = $(this).offset(),
          t = e.left + $(this).outerWidth(!0);
        if (t > $(window).width() && !$(this).hasClass("mega-menu"))
          $(this).addClass("make-right");
        else if (t > $(window).width() && $(this).hasClass("mega-menu")) {
          var a = $(window).width() - e.left,
            i = $(this).outerWidth(!0) - a;
          $(this).css("margin-left", -i);
        }
      }),
      $(".mobile-toggle").click(function () {
        $(".nav-bar").toggleClass("nav-open"), $(this).toggleClass("active");
      }),
      $(".menu li").click(function (e) {
        e || (e = window.event),
          e.stopPropagation(),
          $(this).find("ul").length
            ? $(this).toggleClass("toggle-sub")
            : $(this).parents(".toggle-sub").removeClass("toggle-sub");
      }),
      $(".menu li a").click(function () {
        $(this).hasClass("inner-link") &&
          $(this).closest(".nav-bar").removeClass("nav-open");
      }),
      $(".module.widget-handle").click(function () {
        $(this).toggleClass("toggle-widget-handle");
      }),
      $(".search-widget-handle .search-form input").click(function (e) {
        e || (e = window.event), e.stopPropagation();
      }),
      $(".offscreen-toggle").length
        ? $("body").addClass("has-offscreen-nav")
        : $("body").removeClass("has-offscreen-nav"),
      $(".offscreen-toggle").click(function () {
        $(".main-container").toggleClass("reveal-nav"),
          $("nav").toggleClass("reveal-nav"),
          $(".offscreen-container").toggleClass("reveal-nav");
      }),
      $(".main-container").click(function () {
        $(this).hasClass("reveal-nav") &&
          ($(this).removeClass("reveal-nav"),
          $(".offscreen-container").removeClass("reveal-nav"),
          $("nav").removeClass("reveal-nav"));
      }),
      $(".offscreen-container a").click(function () {
        $(".offscreen-container").removeClass("reveal-nav"),
          $(".main-container").removeClass("reveal-nav"),
          $("nav").removeClass("reveal-nav");
      }),
      $(".projects").each(function () {
        var e = "";
        $(this)
          .find(".project")
          .each(function () {
            $(this)
              .attr("data-filter")
              .split(",")
              .forEach(function (t) {
                -1 == e.indexOf(t) &&
                  (e +=
                    '<li data-filter="' +
                    t +
                    '">' +
                    capitaliseFirstLetter(t) +
                    "</li>");
              }),
              $(this)
                .closest(".projects")
                .find("ul.filters")
                .empty()
                .append('<li data-filter="all" class="active">All</li>')
                .append(e);
          });
      }),
      $(".filters li").click(function () {
        var e = $(this).attr("data-filter");
        $(this).closest(".filters").find("li").removeClass("active"),
          $(this).addClass("active"),
          $(this)
            .closest(".projects")
            .find(".project")
            .each(function () {
              -1 == $(this).attr("data-filter").indexOf(e)
                ? $(this).addClass("inactive")
                : $(this).removeClass("inactive");
            }),
          "all" == e &&
            $(this)
              .closest(".projects")
              .find(".project")
              .removeClass("inactive");
      }),
      $(".instafeed").length &&
        ((jQuery.fn.spectragram.accessData = {
          accessToken: "1406933036.dc95b96.2ed56eddc62f41cbb22c1573d58625a2",
          clientID: "87e6d2b8a0ef4c7ab8bc45e80ddd0c6a",
        }),
        $(".instafeed").each(function () {
          var e = $(this).attr("data-user-name");
          $(this)
            .children("ul")
            .spectragram("getUserFeed", { query: e, max: 12 });
        })),
      $(".flickr-feed").length &&
        $(".flickr-feed").each(function () {
          var e = $(this).attr("data-user-id"),
            t = $(this).attr("data-album-id");
          $(this).flickrPhotoStream({
            id: e,
            setId: t,
            container: '<li class="masonry-item" />',
          }),
            setTimeout(function () {
              initializeMasonry(), window.dispatchEvent(new Event("resize"));
            }, 1e3);
        }),
      $(
        ".slider-all-controls, .slider-paging-controls, .slider-arrow-controls, .slider-thumb-controls, .logo-carousel"
      ).length &&
        ($(".slider-all-controls").flexslider({
          start: function (e) {
            e.find(".slides li:first-child").find(".fs-vid-background video")
              .length &&
              e
                .find(".slides li:first-child")
                .find(".fs-vid-background video")
                .get(0)
                .play();
          },
          after: function (e) {
            e.find(".fs-vid-background video").length &&
              (e
                .find("li:not(.flex-active-slide)")
                .find(".fs-vid-background video").length &&
                e
                  .find("li:not(.flex-active-slide)")
                  .find(".fs-vid-background video")
                  .get(0)
                  .pause(),
              e.find(".flex-active-slide").find(".fs-vid-background video")
                .length &&
                e
                  .find(".flex-active-slide")
                  .find(".fs-vid-background video")
                  .get(0)
                  .play());
          },
        }),
        $(".slider-paging-controls").flexslider({
          animation: "slide",
          directionNav: !1,
        }),
        $(".slider-arrow-controls").flexslider({ controlNav: !1 }),
        $(".slider-thumb-controls .slides li").each(function () {
          var e = $(this).find("img").attr("src");
          $(this).attr("data-thumb", e);
        }),
        $(".slider-thumb-controls").flexslider({
          animation: "slide",
          controlNav: "thumbnails",
          directionNav: !0,
        }),
        $(".logo-carousel").flexslider({
          minItems: 1,
          maxItems: 4,
          move: 1,
          itemWidth: 200,
          itemMargin: 0,
          animation: "slide",
          slideshow: !0,
          slideshowSpeed: 3e3,
          directionNav: !1,
          controlNav: !1,
        })),
      $(".lightbox-grid li a").each(function () {
        var e = $(this).closest(".lightbox-grid").attr("data-gallery-title");
        $(this).attr("data-lightbox", e);
      }),
      $("iframe[data-provider]").each(function () {
        var e = jQuery(this).attr("data-provider"),
          t = jQuery(this).attr("data-video-id"),
          a = jQuery(this).attr("data-autoplay"),
          i = "";
        "vimeo" == e
          ? ((i =
              "http://player.vimeo.com/video/" +
              t +
              "?badge=0&title=0&byline=0&title=0&autoplay=" +
              a),
            $(this).attr("data-src", i))
          : "youtube" == e
          ? ((i =
              "https://www.youtube.com/embed/" +
              t +
              "?showinfo=0&autoplay=" +
              a),
            $(this).attr("data-src", i))
          : console.log(
              "Only Vimeo and Youtube videos are supported at this time"
            );
      }),
      jQuery(".foundry_modal[modal-link]").remove(),
      $(".foundry_modal").length && !jQuery(".modal-screen").length)
    )
      jQuery("<div />").addClass("modal-screen").appendTo("body");
    function i(e) {
      var t, a;
      return (
        $(e)
          .find('.validate-required[type="checkbox"]')
          .each(function () {
            $('[name="' + $(this).attr("name") + '"]:checked').length ||
              ((a = 1),
              (t = $(this).attr("name").replace("[]", "")),
              e
                .find(".form-error")
                .text("Please tick at least one " + t + " box."));
          }),
        $(e)
          .find(".validate-required")
          .each(function () {
            "" === $(this).val()
              ? ($(this).addClass("field-error"), (a = 1))
              : $(this).removeClass("field-error");
          }),
        $(e)
          .find(".validate-email")
          .each(function () {
            /(.+)@(.+){2,}\.(.+){2,}/.test($(this).val())
              ? $(this).removeClass("field-error")
              : ($(this).addClass("field-error"), (a = 1));
          }),
        e.find(".field-error").length || e.find(".form-error").fadeOut(1e3),
        a
      );
    }
    function o(e) {
      return (
        decodeURIComponent(
          (new RegExp("[?|&]" + e + "=([^&;]+?)(&|#|;|$)").exec(
            location.search
          ) || [, ""])[1].replace(/\+/g, "%20")
        ) || null
      );
    }
    if (
      (jQuery(".foundry_modal").click(function () {
        jQuery(this).addClass("modal-acknowledged");
      }),
      jQuery(document).on(
        "wheel mousewheel scroll",
        ".foundry_modal, .modal-screen",
        function (e) {
          return ($(this).get(0).scrollTop += e.originalEvent.deltaY), !1;
        }
      ),
      $(".modal-container:not([modal-link])").each(function (e) {
        if (jQuery(this).find("iframe[src]").length) {
          jQuery(this).find(".foundry_modal").addClass("iframe-modal");
          var t = jQuery(this).find("iframe");
          t.attr("data-src", t.attr("src")), t.attr("src", "");
        }
        jQuery(this).find(".btn-modal").attr("modal-link", e),
          jQuery('.foundry_modal[modal-link="' + e + '"]').length ||
            jQuery(this)
              .find(".foundry_modal")
              .clone()
              .appendTo("body")
              .attr("modal-link", e)
              .prepend(jQuery('<i class="ti-close close-modal">'));
      }),
      $(".btn-modal")
        .unbind("click")
        .click(function () {
          var e = jQuery(
              '.foundry_modal[modal-link="' +
                jQuery(this).attr("modal-link") +
                '"]'
            ),
            t = "";
          if (
            (jQuery(".modal-screen").toggleClass("reveal-modal"),
            e.find("iframe").length)
          ) {
            if ("1" === e.find("iframe").attr("data-autoplay"))
              t = "&autoplay=1";
            e.find("iframe").attr("src", e.find("iframe").attr("data-src") + t);
          }
          return (
            e.find("video").length && e.find("video").get(0).play(),
            e.toggleClass("reveal-modal"),
            !1
          );
        }),
      $(".foundry_modal[data-time-delay]").each(function () {
        var e = $(this),
          t = e.attr("data-time-delay");
        e.prepend($('<i class="ti-close close-modal">')),
          (void 0 !== e.attr("data-cookie") &&
            mr_cookies.hasItem(e.attr("data-cookie"))) ||
            setTimeout(function () {
              e.addClass("reveal-modal"),
                $(".modal-screen").addClass("reveal-modal");
            }, t);
      }),
      $(".foundry_modal[data-show-on-exit]").each(function () {
        var e = $(this),
          t = $(e.attr("data-show-on-exit"));
        $(t).length &&
          (e.prepend($('<i class="ti-close close-modal">')),
          $(document).on("mouseleave", t, function () {
            $("body .reveal-modal").length ||
              (void 0 !== e.attr("data-cookie") &&
                mr_cookies.hasItem(e.attr("data-cookie"))) ||
              (e.addClass("reveal-modal"),
              $(".modal-screen").addClass("reveal-modal"));
          }));
      }),
      $(".foundry_modal[data-hide-after]").each(function () {
        var e = $(this),
          t = e.attr("data-hide-after");
        (void 0 !== e.attr("data-cookie") &&
          mr_cookies.hasItem(e.attr("data-cookie"))) ||
          setTimeout(function () {
            e.hasClass("modal-acknowledged") ||
              (e.removeClass("reveal-modal"),
              $(".modal-screen").removeClass("reveal-modal"));
          }, t);
      }),
      jQuery(".close-modal:not(.modal-strip .close-modal)")
        .unbind("click")
        .click(function () {
          var e = jQuery(this).closest(".foundry_modal");
          e.toggleClass("reveal-modal"),
            void 0 !== e.attr("data-cookie") &&
              mr_cookies.setItem(e.attr("data-cookie"), "true", 1 / 0),
            e.find("iframe").length && e.find("iframe").attr("src", ""),
            jQuery(".modal-screen").removeClass("reveal-modal");
        }),
      jQuery(".modal-screen")
        .unbind("click")
        .click(function () {
          jQuery(".foundry_modal.reveal-modal").find("iframe").length &&
            jQuery(".foundry_modal.reveal-modal")
              .find("iframe")
              .attr("src", ""),
            jQuery(".foundry_modal.reveal-modal").toggleClass("reveal-modal"),
            jQuery(this).toggleClass("reveal-modal");
        }),
      jQuery(document).keyup(function (e) {
        27 == e.keyCode &&
          (jQuery(".foundry_modal").find("iframe").length &&
            jQuery(".foundry_modal").find("iframe").attr("src", ""),
          jQuery(".foundry_modal").removeClass("reveal-modal"),
          jQuery(".modal-screen").removeClass("reveal-modal"));
      }),
      jQuery(".modal-strip").each(function () {
        jQuery(this).find(".close-modal").length ||
          jQuery(this).append(jQuery('<i class="ti-close close-modal">'));
        var e = jQuery(this);
        (void 0 !== e.attr("data-cookie") &&
          mr_cookies.hasItem(e.attr("data-cookie"))) ||
          setTimeout(function () {
            e.addClass("reveal-modal");
          }, 1e3);
      }),
      jQuery(".modal-strip .close-modal").click(function () {
        var e = jQuery(this).closest(".modal-strip");
        return (
          void 0 !== e.attr("data-cookie") &&
            mr_cookies.setItem(e.attr("data-cookie"), "true", 1 / 0),
          jQuery(this).closest(".modal-strip").removeClass("reveal-modal"),
          !1
        );
      }),
      jQuery(".close-iframe").click(function () {
        jQuery(this).closest(".modal-video").removeClass("reveal-modal"),
          jQuery(this).siblings("iframe").attr("src", ""),
          jQuery(this).siblings("video").get(0).pause();
      }),
      $(".checkbox-option").on("click", function () {
        $(this).toggleClass("checked");
        var e = $(this).find("input");
        !1 === e.prop("checked")
          ? e.prop("checked", !0)
          : e.prop("checked", !1);
      }),
      $(".radio-option").click(function () {
        var e = $(this).hasClass("checked"),
          t = $(this).find("input").attr("name");
        e ||
          ($('input[name="' + t + '"]')
            .parent()
            .removeClass("checked"),
          $(this).addClass("checked"),
          $(this).find("input").prop("checked", !0));
      }),
      $(".accordion li").click(function () {
        $(this).closest(".accordion").hasClass("one-open")
          ? ($(this).closest(".accordion").find("li").removeClass("active"),
            $(this).addClass("active"))
          : $(this).toggleClass("active"),
          void 0 !== window.mr_parallax &&
            setTimeout(mr_parallax.windowLoad, 500);
      }),
      $(".tabbed-content").each(function () {
        $(this).append('<ul class="content"></ul>');
      }),
      $(".tabs li").each(function () {
        var e = $(this),
          t = "";
        e.is(".tabs>li:first-child") && (t = ' class="active"');
        var a = e
          .find(".tab-content")
          .detach()
          .wrap("<li" + t + "></li>")
          .parent();
        e.closest(".tabbed-content").find(".content").append(a);
      }),
      $(".tabs li").click(function () {
        $(this).closest(".tabs").find("li").removeClass("active"),
          $(this).addClass("active");
        var e = $(this).index() + 1;
        $(this)
          .closest(".tabbed-content")
          .find(".content>li")
          .removeClass("active"),
          $(this)
            .closest(".tabbed-content")
            .find(".content>li:nth-of-type(" + e + ")")
            .addClass("active");
      }),
      $("section")
        .closest("body")
        .find(".local-video-container .play-button")
        .click(function () {
          $(this).siblings(".background-image-holder").removeClass("fadeIn"),
            $(this).siblings(".background-image-holder").css("z-index", -1),
            $(this).css("opacity", 0),
            $(this).siblings("video").get(0).play();
        }),
      $("section")
        .closest("body")
        .find(".player")
        .each(function () {
          $(this).closest("section").find(".container").addClass("fadeOut");
          var e = $(this).attr("data-video-id"),
            t = $(this).attr("data-start-at");
          $(this).attr(
            "data-property",
            "{videoURL:'http://youtu.be/" +
              e +
              "',containment:'self',autoPlay:true, mute:true, startAt:" +
              t +
              ", opacity:1, showControls:false}"
          );
        }),
      $(".player").length &&
        $(".player").each(function () {
          var e = $(this).closest("section"),
            t = e.find(".player");
          t.YTPlayer(),
            t.on("YTPStart", function (t) {
              e.find(".container").removeClass("fadeOut"),
                e.find(".masonry-loader").addClass("fadeOut");
            });
        }),
      $(".map-holder").click(function () {
        $(this).addClass("interact");
      }),
      $(".map-holder").length &&
        $(window).scroll(function () {
          $(".map-holder.interact").length &&
            $(".map-holder.interact").removeClass("interact");
        }),
      $(".countdown").length &&
        $(".countdown").each(function () {
          var e = $(this).attr("data-date");
          $(this).countdown(e, function (e) {
            $(this).text(e.strftime("%D days %H:%M:%S"));
          });
        }),
      $("form.form-email, form.form-newsletter").submit(function (e) {
        e.preventDefault ? e.preventDefault() : (e.returnValue = !1);
        var t,
          a,
          o,
          r,
          s,
          n,
          l,
          d,
          c,
          m = $(this).closest("form.form-email, form.form-newsletter"),
          f = m.find('button[type="submit"]'),
          u = m.attr("original-error");
        if (
          ((a = $(m).find("iframe.mail-list-form")),
          m.find(".form-error, .form-success").remove(),
          f.attr("data-text", f.text()),
          m.append(
            '<div class="form-error" style="display: none;">' +
              m.attr("data-error") +
              "</div>"
          ),
          m.append(
            '<div class="form-success" style="display: none;">' +
              m.attr("data-success") +
              "</div>"
          ),
          (d = m.find(".form-error")),
          (c = m.find(".form-success")),
          m.addClass("attempted-submit"),
          a.length && void 0 !== a.attr("srcdoc") && "" !== a.attr("srcdoc"))
        )
          if (
            (console.log("Mail list form signup detected."),
            void 0 !== u && !1 !== u && d.html(u),
            (o = $(m).find(".signup-email-field").val()),
            (r = $(m).find(".signup-name-field").val()),
            (s = $(m).find("input.signup-first-name-field").length
              ? $(m).find("input.signup-first-name-field").val()
              : $(m).find(".signup-name-field").val()),
            (n = $(m).find(".signup-last-name-field").val()),
            1 !== i(m))
          ) {
            (t = prepareSignup(a)).find("#mce-EMAIL, #fieldEmail").val(o),
              t.find("#mce-LNAME, #fieldLastName").val(n),
              t.find("#mce-FNAME, #fieldFirstName").val(s),
              t.find("#mce-NAME, #fieldName").val(r),
              m.removeClass("attempted-submit"),
              d.fadeOut(200),
              f
                .html(jQuery("<div />").addClass("form-loading"))
                .attr("disabled", "disabled");
            try {
              $.ajax({
                url: t.attr("action"),
                crossDomain: !0,
                data: t.serialize(),
                method: "GET",
                cache: !1,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (e) {
                  "success" != e.result && 200 != e.Status
                    ? (d.attr("original-error", d.text()),
                      d.html(e.msg).fadeIn(1e3),
                      c.fadeOut(1e3),
                      f.html(f.attr("data-text")).removeAttr("disabled"))
                    : (f.html(f.attr("data-text")).removeAttr("disabled"),
                      void 0 !== (l = m.attr("success-redirect")) &&
                        !1 !== l &&
                        "" !== l &&
                        (window.location = l),
                      m.find('input[type="text"]').val(""),
                      m.find("textarea").val(""),
                      c.fadeIn(1e3),
                      d.fadeOut(1e3),
                      setTimeout(function () {
                        c.fadeOut(500);
                      }, 5e3));
                },
              });
            } catch (e) {
              d.attr("original-error", d.text()),
                d.html(e.message).fadeIn(1e3),
                c.fadeOut(1e3),
                setTimeout(function () {
                  d.fadeOut(500);
                }, 5e3),
                f.html(f.attr("data-text")).removeAttr("disabled");
            }
          } else
            d.fadeIn(1e3),
              setTimeout(function () {
                d.fadeOut(500);
              }, 5e3);
        else
          console.log("Send email form detected."),
            void 0 !== u && !1 !== u && d.text(u),
            1 === i(m)
              ? (d.fadeIn(200),
                setTimeout(function () {
                  d.fadeOut(500);
                }, 3e3))
              : (m.removeClass("attempted-submit"),
                d.fadeOut(200),
                f
                  .html(jQuery("<div />").addClass("form-loading"))
                  .attr("disabled", "disabled"),
                jQuery.ajax({
                  type: "POST",
                  url: "mail/mail.php",
                  data: m.serialize() + "&url=" + window.location.href,
                  success: function (e) {
                    f.html(f.attr("data-text")).removeAttr("disabled"),
                      $.isNumeric(e)
                        ? parseInt(e) > 0 &&
                          (void 0 !== (l = m.attr("success-redirect")) &&
                            !1 !== l &&
                            "" !== l &&
                            (window.location = l),
                          m.find('input[type="text"]').val(""),
                          m.find("textarea").val(""),
                          m.find(".form-success").fadeIn(1e3),
                          d.fadeOut(1e3),
                          setTimeout(function () {
                            c.fadeOut(500);
                          }, 5e3))
                        : (d.attr("original-error", d.text()),
                          d.text(e).fadeIn(1e3),
                          c.fadeOut(1e3));
                  },
                  error: function (e, t, a) {
                    d.attr("original-error", d.text()),
                      d.text(a).fadeIn(1e3),
                      c.fadeOut(1e3),
                      f.html(f.attr("data-text")).removeAttr("disabled");
                  },
                }));
        return !1;
      }),
      $(".validate-required, .validate-email").on("blur change", function () {
        i($(this).closest("form"));
      }),
      $("form").each(function () {
        $(this).find(".form-error").length &&
          $(this).attr("original-error", $(this).find(".form-error").text());
      }),
      o("ref") &&
        $("form.form-email").append(
          '<input type="text" name="referrer" class="hidden" value="' +
            o("ref") +
            '"/>'
        ),
      /Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(
        navigator.userAgent || navigator.vendor || window.opera
      ) && $("section").removeClass("parallax"),
      $(".disqus-comments").length)
    ) {
      var r = $(".disqus-comments").attr("data-shortname");
      ((e = document.createElement("script")).type = "text/javascript"),
        (e.async = !0),
        (e.src = "//" + r + ".disqus.com/embed.js"),
        (
          document.getElementsByTagName("head")[0] ||
          document.getElementsByTagName("body")[0]
        ).appendChild(e);
    }
    if (
      document.querySelector("[data-maps-api-key]") &&
      !document.querySelector(".gMapsAPI") &&
      $("[data-maps-api-key]").length
    ) {
      var s = document.createElement("script"),
        n = $("[data-maps-api-key]:first").attr("data-maps-api-key");
      (s.type = "text/javascript"),
        (s.src =
          "https://maps.googleapis.com/maps/api/js?key=" +
          n +
          "&callback=initializeMaps"),
        (s.className = "gMapsAPI"),
        document.body.appendChild(s);
    }
  }),
  $(window).load(function () {
    "use strict";
    setTimeout(initializeMasonry, 1e3),
      (mr_firstSectionHeight = $(
        ".main-container section:nth-of-type(1)"
      ).outerHeight(!0));
  }),
  (window.initializeMaps = function () {
    "undefined" != typeof google &&
      void 0 !== google.maps &&
      $(".map-canvas[data-maps-api-key]").each(function () {
        var e,
          t,
          a = this,
          i =
            void 0 !== $(this).attr("data-map-style") &&
            $(this).attr("data-map-style"),
          o = JSON.parse(i) || [
            {
              featureType: "landscape",
              stylers: [
                { saturation: -100 },
                { lightness: 65 },
                { visibility: "on" },
              ],
            },
            {
              featureType: "poi",
              stylers: [
                { saturation: -100 },
                { lightness: 51 },
                { visibility: "simplified" },
              ],
            },
            {
              featureType: "road.highway",
              stylers: [{ saturation: -100 }, { visibility: "simplified" }],
            },
            {
              featureType: "road.arterial",
              stylers: [
                { saturation: -100 },
                { lightness: 30 },
                { visibility: "on" },
              ],
            },
            {
              featureType: "road.local",
              stylers: [
                { saturation: -100 },
                { lightness: 40 },
                { visibility: "on" },
              ],
            },
            {
              featureType: "transit",
              stylers: [{ saturation: -100 }, { visibility: "simplified" }],
            },
            {
              featureType: "administrative.province",
              stylers: [{ visibility: "off" }],
            },
            {
              featureType: "water",
              elementType: "labels",
              stylers: [
                { visibility: "on" },
                { lightness: -25 },
                { saturation: -100 },
              ],
            },
            {
              featureType: "water",
              elementType: "geometry",
              stylers: [
                { hue: "#ffff00" },
                { lightness: -25 },
                { saturation: -97 },
              ],
            },
          ],
          r =
            void 0 !== $(this).attr("data-map-zoom") &&
            "" !== $(this).attr("data-map-zoom")
              ? 1 * $(this).attr("data-map-zoom")
              : 17,
          s =
            void 0 !== $(this).attr("data-latlong") &&
            $(this).attr("data-latlong"),
          n = !!s && 1 * s.substr(0, s.indexOf(",")),
          l = !!s && 1 * s.substr(s.indexOf(",") + 1),
          d = new google.maps.Geocoder(),
          c =
            void 0 !== $(this).attr("data-address")
              ? $(this).attr("data-address").split(";")
              : [""],
          m = "We Are Here",
          f = {
            draggable: $(document).width() > 766,
            scrollwheel: !1,
            zoom: r,
            disableDefaultUI: !0,
            styles: o,
          };
        null != $(this).attr("data-marker-title") &&
          "" != $(this).attr("data-marker-title") &&
          (m = $(this).attr("data-marker-title")),
          null != c && "" != c[0]
            ? d.geocode(
                { address: c[0].replace("[nomarker]", "") },
                function (e, i) {
                  if (i == google.maps.GeocoderStatus.OK) {
                    var o = new google.maps.Map(a, f);
                    o.setCenter(e[0].geometry.location),
                      c.forEach(function (e) {
                        if (
                          ((t = {
                            url:
                              null == window.mr_variant
                                ? "img/mapmarker.png"
                                : "../img/mapmarker.png",
                            size: new google.maps.Size(50, 50),
                            scaledSize: new google.maps.Size(50, 50),
                          }),
                          /(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)/.test(e))
                        ) {
                          var a = e.split(",");
                          new google.maps.Marker({
                            position: { lat: 1 * a[0], lng: 1 * a[1] },
                            map: o,
                            icon: t,
                            title: m,
                            optimised: !1,
                          });
                        } else
                          e.indexOf("[nomarker]") < 0 &&
                            new google.maps.Geocoder().geocode(
                              { address: e.replace("[nomarker]", "") },
                              function (e, a) {
                                a == google.maps.GeocoderStatus.OK &&
                                  new google.maps.Marker({
                                    map: o,
                                    icon: t,
                                    title: m,
                                    position: e[0].geometry.location,
                                    optimised: !1,
                                  });
                              }
                            );
                      });
                  } else
                    console.log("There was a problem geocoding the address.");
                }
              )
            : null != n &&
              "" != n &&
              0 != n &&
              null != l &&
              "" != l &&
              0 != l &&
              ((f.center = { lat: n, lng: l }),
              (e = new google.maps.Map(a, f)),
              new google.maps.Marker({
                position: { lat: n, lng: l },
                map: e,
                icon: t,
                title: m,
              }));
      });
  }),
  initializeMaps();
var mr_cookies = {
  getItem: function (e) {
    return (
      (e &&
        decodeURIComponent(
          document.cookie.replace(
            new RegExp(
              "(?:(?:^|.*;)\\s*" +
                encodeURIComponent(e).replace(/[\-\.\+\*]/g, "\\$&") +
                "\\s*\\=\\s*([^;]*).*$)|^.*$"
            ),
            "$1"
          )
        )) ||
      null
    );
  },
  setItem: function (e, t, a, i, o, r) {
    if (!e || /^(?:expires|max\-age|path|domain|secure)$/i.test(e)) return !1;
    var s = "";
    if (a)
      switch (a.constructor) {
        case Number:
          s =
            a === 1 / 0
              ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT"
              : "; max-age=" + a;
          break;
        case String:
          s = "; expires=" + a;
          break;
        case Date:
          s = "; expires=" + a.toUTCString();
      }
    return (
      (document.cookie =
        encodeURIComponent(e) +
        "=" +
        encodeURIComponent(t) +
        s +
        (o ? "; domain=" + o : "") +
        (i ? "; path=" + i : "") +
        (r ? "; secure" : "")),
      !0
    );
  },
  removeItem: function (e, t, a) {
    return (
      !!this.hasItem(e) &&
      ((document.cookie =
        encodeURIComponent(e) +
        "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" +
        (a ? "; domain=" + a : "") +
        (t ? "; path=" + t : "")),
      !0)
    );
  },
  hasItem: function (e) {
    return (
      !!e &&
      new RegExp(
        "(?:^|;\\s*)" +
          encodeURIComponent(e).replace(/[\-\.\+\*]/g, "\\$&") +
          "\\s*\\="
      ).test(document.cookie)
    );
  },
  keys: function () {
    for (
      var e = document.cookie
          .replace(
            /((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g,
            ""
          )
          .split(/\s*(?:\=[^;]*)?;\s*/),
        t = e.length,
        a = 0;
      a < t;
      a++
    )
      e[a] = decodeURIComponent(e[a]);
    return e;
  },
};

/*!
 * Fotorama 4.6.4 | http://fotorama.io/license/
 */
(fotoramaVersion = "4.6.4"),
  (function (a, b, c, d, e) {
    "use strict";
    function f(a) {
      var b = "bez_" + d.makeArray(arguments).join("_").replace(".", "p");
      if ("function" != typeof d.easing[b]) {
        var c = function (a, b) {
          var c = [null, null],
            d = [null, null],
            e = [null, null],
            f = function (f, g) {
              return (
                (e[g] = 3 * a[g]),
                (d[g] = 3 * (b[g] - a[g]) - e[g]),
                (c[g] = 1 - e[g] - d[g]),
                f * (e[g] + f * (d[g] + f * c[g]))
              );
            },
            g = function (a) {
              return e[0] + a * (2 * d[0] + 3 * c[0] * a);
            },
            h = function (a) {
              for (
                var b, c = a, d = 0;
                ++d < 14 && ((b = f(c, 0) - a), !(Math.abs(b) < 0.001));

              )
                c -= b / g(c);
              return c;
            };
          return function (a) {
            return f(h(a), 1);
          };
        };
        d.easing[b] = function (b, d, e, f, g) {
          return f * c([a[0], a[1]], [a[2], a[3]])(d / g) + e;
        };
      }
      return b;
    }
    function g() {}
    function h(a, b, c) {
      return Math.max(isNaN(b) ? -1 / 0 : b, Math.min(isNaN(c) ? 1 / 0 : c, a));
    }
    function i(a) {
      return a.match(/ma/) && a.match(/-?\d+(?!d)/g)[a.match(/3d/) ? 12 : 4];
    }
    function j(a) {
      return Ic ? +i(a.css("transform")) : +a.css("left").replace("px", "");
    }
    function k(a) {
      var b = {};
      return (
        Ic ? (b.transform = "translate3d(" + a + "px,0,0)") : (b.left = a), b
      );
    }
    function l(a) {
      return { "transition-duration": a + "ms" };
    }
    function m(a, b) {
      return isNaN(a) ? b : a;
    }
    function n(a, b) {
      return m(+String(a).replace(b || "px", ""));
    }
    function o(a) {
      return /%$/.test(a) ? n(a, "%") : e;
    }
    function p(a, b) {
      return m((o(a) / 100) * b, n(a));
    }
    function q(a) {
      return (!isNaN(n(a)) || !isNaN(n(a, "%"))) && a;
    }
    function r(a, b, c, d) {
      return (a - (d || 0)) * (b + (c || 0));
    }
    function s(a, b, c, d) {
      return -Math.round(a / (b + (c || 0)) - (d || 0));
    }
    function t(a) {
      var b = a.data();
      if (!b.tEnd) {
        var c = a[0],
          d = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            msTransition: "MSTransitionEnd",
            transition: "transitionend",
          };
        T(c, d[uc.prefixed("transition")], function (a) {
          b.tProp && a.propertyName.match(b.tProp) && b.onEndFn();
        }),
          (b.tEnd = !0);
      }
    }
    function u(a, b, c, d) {
      var e,
        f = a.data();
      f &&
        ((f.onEndFn = function () {
          e || ((e = !0), clearTimeout(f.tT), c());
        }),
        (f.tProp = b),
        clearTimeout(f.tT),
        (f.tT = setTimeout(function () {
          f.onEndFn();
        }, 1.5 * d)),
        t(a));
    }
    function v(a, b) {
      if (a.length) {
        var c = a.data();
        Ic ? (a.css(l(0)), (c.onEndFn = g), clearTimeout(c.tT)) : a.stop();
        var d = w(b, function () {
          return j(a);
        });
        return a.css(k(d)), d;
      }
    }
    function w() {
      for (
        var a, b = 0, c = arguments.length;
        c > b &&
        ((a = b ? arguments[b]() : arguments[b]), "number" != typeof a);
        b++
      );
      return a;
    }
    function x(a, b) {
      return Math.round(a + (b - a) / 1.5);
    }
    function y() {
      return (
        (y.p = y.p || ("https:" === c.protocol ? "https://" : "http://")), y.p
      );
    }
    function z(a) {
      var c = b.createElement("a");
      return (c.href = a), c;
    }
    function A(a, b) {
      if ("string" != typeof a) return a;
      a = z(a);
      var c, d;
      if (a.host.match(/youtube\.com/) && a.search) {
        if ((c = a.search.split("v=")[1])) {
          var e = c.indexOf("&");
          -1 !== e && (c = c.substring(0, e)), (d = "youtube");
        }
      } else
        a.host.match(/youtube\.com|youtu\.be/)
          ? ((c = a.pathname
              .replace(/^\/(embed\/|v\/)?/, "")
              .replace(/\/.*/, "")),
            (d = "youtube"))
          : a.host.match(/vimeo\.com/) &&
            ((d = "vimeo"),
            (c = a.pathname.replace(/^\/(video\/)?/, "").replace(/\/.*/, "")));
      return (
        (c && d) || !b || ((c = a.href), (d = "custom")),
        c ? { id: c, type: d, s: a.search.replace(/^\?/, ""), p: y() } : !1
      );
    }
    function B(a, b, c) {
      var e,
        f,
        g = a.video;
      return (
        "youtube" === g.type
          ? ((f = y() + "img.youtube.com/vi/" + g.id + "/default.jpg"),
            (e = f.replace(/\/default.jpg$/, "/hqdefault.jpg")),
            (a.thumbsReady = !0))
          : "vimeo" === g.type
          ? d.ajax({
              url: y() + "vimeo.com/api/v2/video/" + g.id + ".json",
              dataType: "jsonp",
              success: function (d) {
                (a.thumbsReady = !0),
                  C(
                    b,
                    { img: d[0].thumbnail_large, thumb: d[0].thumbnail_small },
                    a.i,
                    c
                  );
              },
            })
          : (a.thumbsReady = !0),
        { img: e, thumb: f }
      );
    }
    function C(a, b, c, e) {
      for (var f = 0, g = a.length; g > f; f++) {
        var h = a[f];
        if (h.i === c && h.thumbsReady) {
          var i = { videoReady: !0 };
          (i[Xc] = i[Zc] = i[Yc] = !1), e.splice(f, 1, d.extend({}, h, i, b));
          break;
        }
      }
    }
    function D(a) {
      function b(a, b, e) {
        var f = a.children("img").eq(0),
          g = a.attr("href"),
          h = a.attr("src"),
          i = f.attr("src"),
          j = b.video,
          k = e ? A(g, j === !0) : !1;
        k ? (g = !1) : (k = j),
          c(
            a,
            f,
            d.extend(b, {
              video: k,
              img: b.img || g || h || i,
              thumb: b.thumb || i || h || g,
            })
          );
      }
      function c(a, b, c) {
        var e = c.thumb && c.img !== c.thumb,
          f = n(c.width || a.attr("width")),
          g = n(c.height || a.attr("height"));
        d.extend(c, {
          width: f,
          height: g,
          thumbratio: S(
            c.thumbratio ||
              n(c.thumbwidth || (b && b.attr("width")) || e || f) /
                n(c.thumbheight || (b && b.attr("height")) || e || g)
          ),
        });
      }
      var e = [];
      return (
        a.children().each(function () {
          var a = d(this),
            f = R(d.extend(a.data(), { id: a.attr("id") }));
          if (a.is("a, img")) b(a, f, !0);
          else {
            if (a.is(":empty")) return;
            c(a, null, d.extend(f, { html: this, _html: a.html() }));
          }
          e.push(f);
        }),
        e
      );
    }
    function E(a) {
      return 0 === a.offsetWidth && 0 === a.offsetHeight;
    }
    function F(a) {
      return !d.contains(b.documentElement, a);
    }
    function G(a, b, c, d) {
      return (
        G.i || ((G.i = 1), (G.ii = [!0])),
        (d = d || G.i),
        "undefined" == typeof G.ii[d] && (G.ii[d] = !0),
        a()
          ? b()
          : G.ii[d] &&
            setTimeout(function () {
              G.ii[d] && G(a, b, c, d);
            }, c || 100),
        G.i++
      );
    }
    function H(a) {
      c.replace(
        c.protocol +
          "//" +
          c.host +
          c.pathname.replace(/^\/?/, "/") +
          c.search +
          "#" +
          a
      );
    }
    function I(a, b, c, d) {
      var e = a.data(),
        f = e.measures;
      if (
        f &&
        (!e.l ||
          e.l.W !== f.width ||
          e.l.H !== f.height ||
          e.l.r !== f.ratio ||
          e.l.w !== b.w ||
          e.l.h !== b.h ||
          e.l.m !== c ||
          e.l.p !== d)
      ) {
        var g = f.width,
          i = f.height,
          j = b.w / b.h,
          k = f.ratio >= j,
          l = "scaledown" === c,
          m = "contain" === c,
          n = "cover" === c,
          o = $(d);
        (k && (l || m)) || (!k && n)
          ? ((g = h(b.w, 0, l ? g : 1 / 0)), (i = g / f.ratio))
          : ((k && n) || (!k && (l || m))) &&
            ((i = h(b.h, 0, l ? i : 1 / 0)), (g = i * f.ratio)),
          a.css({
            width: g,
            height: i,
            left: p(o.x, b.w - g),
            top: p(o.y, b.h - i),
          }),
          (e.l = {
            W: f.width,
            H: f.height,
            r: f.ratio,
            w: b.w,
            h: b.h,
            m: c,
            p: d,
          });
      }
      return !0;
    }
    function J(a, b) {
      var c = a[0];
      c.styleSheet ? (c.styleSheet.cssText = b) : a.html(b);
    }
    function K(a, b, c) {
      return b === c ? !1 : b >= a ? "left" : a >= c ? "right" : "left right";
    }
    function L(a, b, c, d) {
      if (!c) return !1;
      if (!isNaN(a)) return a - (d ? 0 : 1);
      for (var e, f = 0, g = b.length; g > f; f++) {
        var h = b[f];
        if (h.id === a) {
          e = f;
          break;
        }
      }
      return e;
    }
    function M(a, b, c) {
      (c = c || {}),
        a.each(function () {
          var a,
            e = d(this),
            f = e.data();
          f.clickOn ||
            ((f.clickOn = !0),
            d.extend(
              cb(e, {
                onStart: function (b) {
                  (a = b), (c.onStart || g).call(this, b);
                },
                onMove: c.onMove || g,
                onTouchEnd: c.onTouchEnd || g,
                onEnd: function (c) {
                  c.moved || b.call(this, a);
                },
              }),
              { noMove: !0 }
            ));
        });
    }
    function N(a, b) {
      return '<div class="' + a + '">' + (b || "") + "</div>";
    }
    function O(a) {
      for (var b = a.length; b; ) {
        var c = Math.floor(Math.random() * b--),
          d = a[b];
        (a[b] = a[c]), (a[c] = d);
      }
      return a;
    }
    function P(a) {
      return (
        "[object Array]" == Object.prototype.toString.call(a) &&
        d.map(a, function (a) {
          return d.extend({}, a);
        })
      );
    }
    function Q(a, b, c) {
      a.scrollLeft(b || 0).scrollTop(c || 0);
    }
    function R(a) {
      if (a) {
        var b = {};
        return (
          d.each(a, function (a, c) {
            b[a.toLowerCase()] = c;
          }),
          b
        );
      }
    }
    function S(a) {
      if (a) {
        var b = +a;
        return isNaN(b) ? ((b = a.split("/")), +b[0] / +b[1] || e) : b;
      }
    }
    function T(a, b, c, d) {
      b &&
        (a.addEventListener
          ? a.addEventListener(b, c, !!d)
          : a.attachEvent("on" + b, c));
    }
    function U(a) {
      return !!a.getAttribute("disabled");
    }
    function V(a) {
      return { tabindex: -1 * a + "", disabled: a };
    }
    function W(a, b) {
      T(a, "keyup", function (c) {
        U(a) || (13 == c.keyCode && b.call(a, c));
      });
    }
    function X(a, b) {
      T(
        a,
        "focus",
        (a.onfocusin = function (c) {
          b.call(a, c);
        }),
        !0
      );
    }
    function Y(a, b) {
      a.preventDefault ? a.preventDefault() : (a.returnValue = !1),
        b && a.stopPropagation && a.stopPropagation();
    }
    function Z(a) {
      return a ? ">" : "<";
    }
    function $(a) {
      return (
        (a = (a + "").split(/\s+/)), { x: q(a[0]) || bd, y: q(a[1]) || bd }
      );
    }
    function _(a, b) {
      var c = a.data(),
        e = Math.round(b.pos),
        f = function () {
          (c.sliding = !1), (b.onEnd || g)();
        };
      "undefined" != typeof b.overPos &&
        b.overPos !== b.pos &&
        ((e = b.overPos),
        (f = function () {
          _(
            a,
            d.extend({}, b, { overPos: b.pos, time: Math.max(Qc, b.time / 2) })
          );
        }));
      var h = d.extend(k(e), b.width && { width: b.width });
      (c.sliding = !0),
        Ic
          ? (a.css(d.extend(l(b.time), h)),
            b.time > 10 ? u(a, "transform", f, b.time) : f())
          : a.stop().animate(h, b.time, _c, f);
    }
    function ab(a, b, c, e, f, h) {
      var i = "undefined" != typeof h;
      if (
        i ||
        (f.push(arguments),
        Array.prototype.push.call(arguments, f.length),
        !(f.length > 1))
      ) {
        (a = a || d(a)), (b = b || d(b));
        var j = a[0],
          k = b[0],
          l = "crossfade" === e.method,
          m = function () {
            if (!m.done) {
              m.done = !0;
              var a = (i || f.shift()) && f.shift();
              a && ab.apply(this, a), (e.onEnd || g)(!!a);
            }
          },
          n = e.time / (h || 1);
        c.removeClass(Rb + " " + Qb),
          a.stop().addClass(Rb),
          b.stop().addClass(Qb),
          l && k && a.fadeTo(0, 0),
          a.fadeTo(l ? n : 0, 1, l && m),
          b.fadeTo(n, 0, m),
          (j && l) || k || m();
      }
    }
    function bb(a) {
      var b = (a.touches || [])[0] || a;
      (a._x = b.pageX), (a._y = b.clientY), (a._now = d.now());
    }
    function cb(a, c) {
      function e(a) {
        return (
          (m = d(a.target)),
          (u.checked = p = q = s = !1),
          k ||
          u.flow ||
          (a.touches && a.touches.length > 1) ||
          a.which > 1 ||
          (ed && ed.type !== a.type && gd) ||
          (p = c.select && m.is(c.select, t))
            ? p
            : ((o = "touchstart" === a.type),
              (q = m.is("a, a *", t)),
              (n = u.control),
              (r = u.noMove || u.noSwipe || n ? 16 : u.snap ? 0 : 4),
              bb(a),
              (l = ed = a),
              (fd = a.type
                .replace(/down|start/, "move")
                .replace(/Down/, "Move")),
              (c.onStart || g).call(t, a, { control: n, $target: m }),
              (k = u.flow = !0),
              void ((!o || u.go) && Y(a)))
        );
      }
      function f(a) {
        if (
          (a.touches && a.touches.length > 1) ||
          (Nc && !a.isPrimary) ||
          fd !== a.type ||
          !k
        )
          return k && h(), void (c.onTouchEnd || g)();
        bb(a);
        var b = Math.abs(a._x - l._x),
          d = Math.abs(a._y - l._y),
          e = b - d,
          f = (u.go || u.x || e >= 0) && !u.noSwipe,
          i = 0 > e;
        o && !u.checked
          ? (k = f) && Y(a)
          : (Y(a), (c.onMove || g).call(t, a, { touch: o })),
          !s && Math.sqrt(Math.pow(b, 2) + Math.pow(d, 2)) > r && (s = !0),
          (u.checked = u.checked || f || i);
      }
      function h(a) {
        (c.onTouchEnd || g)();
        var b = k;
        (u.control = k = !1),
          b && (u.flow = !1),
          !b ||
            (q && !u.checked) ||
            (a && Y(a),
            (gd = !0),
            clearTimeout(hd),
            (hd = setTimeout(function () {
              gd = !1;
            }, 1e3)),
            (c.onEnd || g).call(t, {
              moved: s,
              $target: m,
              control: n,
              touch: o,
              startEvent: l,
              aborted: !a || "MSPointerCancel" === a.type,
            }));
      }
      function i() {
        u.flow ||
          setTimeout(function () {
            u.flow = !0;
          }, 10);
      }
      function j() {
        u.flow &&
          setTimeout(function () {
            u.flow = !1;
          }, Pc);
      }
      var k,
        l,
        m,
        n,
        o,
        p,
        q,
        r,
        s,
        t = a[0],
        u = {};
      return (
        Nc
          ? (T(t, "MSPointerDown", e),
            T(b, "MSPointerMove", f),
            T(b, "MSPointerCancel", h),
            T(b, "MSPointerUp", h))
          : (T(t, "touchstart", e),
            T(t, "touchmove", f),
            T(t, "touchend", h),
            T(b, "touchstart", i),
            T(b, "touchend", j),
            T(b, "touchcancel", j),
            Ec.on("scroll", j),
            a.on("mousedown", e),
            Fc.on("mousemove", f).on("mouseup", h)),
        a.on("click", "a", function (a) {
          u.checked && Y(a);
        }),
        u
      );
    }
    function db(a, b) {
      function c(c, d) {
        (A = !0),
          (j = l = c._x),
          (q = c._now),
          (p = [[q, j]]),
          (m = n = D.noMove || d ? 0 : v(a, (b.getPos || g)())),
          (b.onStart || g).call(B, c);
      }
      function e(a, b) {
        (s = D.min),
          (t = D.max),
          (u = D.snap),
          (w = a.altKey),
          (A = z = !1),
          (y = b.control),
          y || C.sliding || c(a);
      }
      function f(d, e) {
        D.noSwipe ||
          (A || c(d),
          (l = d._x),
          p.push([d._now, l]),
          (n = m - (j - l)),
          (o = K(n, s, t)),
          s >= n ? (n = x(n, s)) : n >= t && (n = x(n, t)),
          D.noMove ||
            (a.css(k(n)),
            z || ((z = !0), e.touch || Nc || a.addClass(ec)),
            (b.onMove || g).call(B, d, { pos: n, edge: o })));
      }
      function i(e) {
        if (!D.noSwipe || !e.moved) {
          A || c(e.startEvent, !0),
            e.touch || Nc || a.removeClass(ec),
            (r = d.now());
          for (
            var f,
              i,
              j,
              k,
              o,
              q,
              v,
              x,
              y,
              z = r - Pc,
              C = null,
              E = Qc,
              F = b.friction,
              G = p.length - 1;
            G >= 0;
            G--
          ) {
            if (((f = p[G][0]), (i = Math.abs(f - z)), null === C || j > i))
              (C = f), (k = p[G][1]);
            else if (C === z || i > j) break;
            j = i;
          }
          v = h(n, s, t);
          var H = k - l,
            I = H >= 0,
            J = r - C,
            K = J > Pc,
            L = !K && n !== m && v === n;
          u &&
            ((v = h(
              Math[L ? (I ? "floor" : "ceil") : "round"](n / u) * u,
              s,
              t
            )),
            (s = t = v)),
            L &&
              (u || v === n) &&
              ((y = -(H / J)),
              (E *= h(Math.abs(y), b.timeLow, b.timeHigh)),
              (o = Math.round(n + (y * E) / F)),
              u || (v = o),
              ((!I && o > t) || (I && s > o)) &&
                ((q = I ? s : t),
                (x = o - q),
                u || (v = q),
                (x = h(v + 0.03 * x, q - 50, q + 50)),
                (E = Math.abs((n - x) / (y / F))))),
            (E *= w ? 10 : 1),
            (b.onEnd || g).call(
              B,
              d.extend(e, {
                moved: e.moved || (K && u),
                pos: n,
                newPos: v,
                overPos: x,
                time: E,
              })
            );
        }
      }
      var j,
        l,
        m,
        n,
        o,
        p,
        q,
        r,
        s,
        t,
        u,
        w,
        y,
        z,
        A,
        B = a[0],
        C = a.data(),
        D = {};
      return (D = d.extend(
        cb(b.$wrap, d.extend({}, b, { onStart: e, onMove: f, onEnd: i })),
        D
      ));
    }
    function eb(a, b) {
      var c,
        e,
        f,
        h = a[0],
        i = { prevent: {} };
      return (
        T(h, Oc, function (a) {
          var h = a.wheelDeltaY || -1 * a.deltaY || 0,
            j = a.wheelDeltaX || -1 * a.deltaX || 0,
            k = Math.abs(j) && !Math.abs(h),
            l = Z(0 > j),
            m = e === l,
            n = d.now(),
            o = Pc > n - f;
          (e = l),
            (f = n),
            k &&
              i.ok &&
              (!i.prevent[l] || c) &&
              (Y(a, !0),
              (c && m && o) ||
                (b.shift &&
                  ((c = !0),
                  clearTimeout(i.t),
                  (i.t = setTimeout(function () {
                    c = !1;
                  }, Rc))),
                (b.onEnd || g)(a, b.shift ? l : j)));
        }),
        i
      );
    }
    function fb() {
      d.each(d.Fotorama.instances, function (a, b) {
        b.index = a;
      });
    }
    function gb(a) {
      d.Fotorama.instances.push(a), fb();
    }
    function hb(a) {
      d.Fotorama.instances.splice(a.index, 1), fb();
    }
    var ib = "fotorama",
      jb = "fullscreen",
      kb = ib + "__wrap",
      lb = kb + "--css2",
      mb = kb + "--css3",
      nb = kb + "--video",
      ob = kb + "--fade",
      pb = kb + "--slide",
      qb = kb + "--no-controls",
      rb = kb + "--no-shadows",
      sb = kb + "--pan-y",
      tb = kb + "--rtl",
      ub = kb + "--only-active",
      vb = kb + "--no-captions",
      wb = kb + "--toggle-arrows",
      xb = ib + "__stage",
      yb = xb + "__frame",
      zb = yb + "--video",
      Ab = xb + "__shaft",
      Bb = ib + "__grab",
      Cb = ib + "__pointer",
      Db = ib + "__arr",
      Eb = Db + "--disabled",
      Fb = Db + "--prev",
      Gb = Db + "--next",
      Hb = ib + "__nav",
      Ib = Hb + "-wrap",
      Jb = Hb + "__shaft",
      Kb = Hb + "--dots",
      Lb = Hb + "--thumbs",
      Mb = Hb + "__frame",
      Nb = Mb + "--dot",
      Ob = Mb + "--thumb",
      Pb = ib + "__fade",
      Qb = Pb + "-front",
      Rb = Pb + "-rear",
      Sb = ib + "__shadow",
      Tb = Sb + "s",
      Ub = Tb + "--left",
      Vb = Tb + "--right",
      Wb = ib + "__active",
      Xb = ib + "__select",
      Yb = ib + "--hidden",
      Zb = ib + "--fullscreen",
      $b = ib + "__fullscreen-icon",
      _b = ib + "__error",
      ac = ib + "__loading",
      bc = ib + "__loaded",
      cc = bc + "--full",
      dc = bc + "--img",
      ec = ib + "__grabbing",
      fc = ib + "__img",
      gc = fc + "--full",
      hc = ib + "__dot",
      ic = ib + "__thumb",
      jc = ic + "-border",
      kc = ib + "__html",
      lc = ib + "__video",
      mc = lc + "-play",
      nc = lc + "-close",
      oc = ib + "__caption",
      pc = ib + "__caption__wrap",
      qc = ib + "__spinner",
      rc = '" tabindex="0" role="button',
      sc = d && d.fn.jquery.split(".");
    if (!sc || sc[0] < 1 || (1 == sc[0] && sc[1] < 8))
      throw "Fotorama requires jQuery 1.8 or later and will not run without it.";
    var tc = {},
      uc = (function (a, b, c) {
        function d(a) {
          r.cssText = a;
        }
        function e(a, b) {
          return typeof a === b;
        }
        function f(a, b) {
          return !!~("" + a).indexOf(b);
        }
        function g(a, b) {
          for (var d in a) {
            var e = a[d];
            if (!f(e, "-") && r[e] !== c) return "pfx" == b ? e : !0;
          }
          return !1;
        }
        function h(a, b, d) {
          for (var f in a) {
            var g = b[a[f]];
            if (g !== c)
              return d === !1 ? a[f] : e(g, "function") ? g.bind(d || b) : g;
          }
          return !1;
        }
        function i(a, b, c) {
          var d = a.charAt(0).toUpperCase() + a.slice(1),
            f = (a + " " + u.join(d + " ") + d).split(" ");
          return e(b, "string") || e(b, "undefined")
            ? g(f, b)
            : ((f = (a + " " + v.join(d + " ") + d).split(" ")), h(f, b, c));
        }
        var j,
          k,
          l,
          m = "2.6.2",
          n = {},
          o = b.documentElement,
          p = "modernizr",
          q = b.createElement(p),
          r = q.style,
          s = ({}.toString, " -webkit- -moz- -o- -ms- ".split(" ")),
          t = "Webkit Moz O ms",
          u = t.split(" "),
          v = t.toLowerCase().split(" "),
          w = {},
          x = [],
          y = x.slice,
          z = function (a, c, d, e) {
            var f,
              g,
              h,
              i,
              j = b.createElement("div"),
              k = b.body,
              l = k || b.createElement("body");
            if (parseInt(d, 10))
              for (; d--; )
                (h = b.createElement("div")),
                  (h.id = e ? e[d] : p + (d + 1)),
                  j.appendChild(h);
            return (
              (f = ["&#173;", '<style id="s', p, '">', a, "</style>"].join("")),
              (j.id = p),
              ((k ? j : l).innerHTML += f),
              l.appendChild(j),
              k ||
                ((l.style.background = ""),
                (l.style.overflow = "hidden"),
                (i = o.style.overflow),
                (o.style.overflow = "hidden"),
                o.appendChild(l)),
              (g = c(j, a)),
              k
                ? j.parentNode.removeChild(j)
                : (l.parentNode.removeChild(l), (o.style.overflow = i)),
              !!g
            );
          },
          A = {}.hasOwnProperty;
        (l =
          e(A, "undefined") || e(A.call, "undefined")
            ? function (a, b) {
                return b in a && e(a.constructor.prototype[b], "undefined");
              }
            : function (a, b) {
                return A.call(a, b);
              }),
          Function.prototype.bind ||
            (Function.prototype.bind = function (a) {
              var b = this;
              if ("function" != typeof b) throw new TypeError();
              var c = y.call(arguments, 1),
                d = function () {
                  if (this instanceof d) {
                    var e = function () {};
                    e.prototype = b.prototype;
                    var f = new e(),
                      g = b.apply(f, c.concat(y.call(arguments)));
                    return Object(g) === g ? g : f;
                  }
                  return b.apply(a, c.concat(y.call(arguments)));
                };
              return d;
            }),
          (w.csstransforms3d = function () {
            var a = !!i("perspective");
            return a;
          });
        for (var B in w)
          l(w, B) &&
            ((k = B.toLowerCase()),
            (n[k] = w[B]()),
            x.push((n[k] ? "" : "no-") + k));
        return (
          (n.addTest = function (a, b) {
            if ("object" == typeof a)
              for (var d in a) l(a, d) && n.addTest(d, a[d]);
            else {
              if (((a = a.toLowerCase()), n[a] !== c)) return n;
              (b = "function" == typeof b ? b() : b),
                "undefined" != typeof enableClasses &&
                  enableClasses &&
                  (o.className += " " + (b ? "" : "no-") + a),
                (n[a] = b);
            }
            return n;
          }),
          d(""),
          (q = j = null),
          (n._version = m),
          (n._prefixes = s),
          (n._domPrefixes = v),
          (n._cssomPrefixes = u),
          (n.testProp = function (a) {
            return g([a]);
          }),
          (n.testAllProps = i),
          (n.testStyles = z),
          (n.prefixed = function (a, b, c) {
            return b ? i(a, b, c) : i(a, "pfx");
          }),
          n
        );
      })(a, b),
      vc = {
        ok: !1,
        is: function () {
          return !1;
        },
        request: function () {},
        cancel: function () {},
        event: "",
        prefix: "",
      },
      wc = "webkit moz o ms khtml".split(" ");
    if ("undefined" != typeof b.cancelFullScreen) vc.ok = !0;
    else
      for (var xc = 0, yc = wc.length; yc > xc; xc++)
        if (
          ((vc.prefix = wc[xc]),
          "undefined" != typeof b[vc.prefix + "CancelFullScreen"])
        ) {
          vc.ok = !0;
          break;
        }
    vc.ok &&
      ((vc.event = vc.prefix + "fullscreenchange"),
      (vc.is = function () {
        switch (this.prefix) {
          case "":
            return b.fullScreen;
          case "webkit":
            return b.webkitIsFullScreen;
          default:
            return b[this.prefix + "FullScreen"];
        }
      }),
      (vc.request = function (a) {
        return "" === this.prefix
          ? a.requestFullScreen()
          : a[this.prefix + "RequestFullScreen"]();
      }),
      (vc.cancel = function () {
        return "" === this.prefix
          ? b.cancelFullScreen()
          : b[this.prefix + "CancelFullScreen"]();
      }));
    var zc,
      Ac = {
        lines: 12,
        length: 5,
        width: 2,
        radius: 7,
        corners: 1,
        rotate: 15,
        color: "rgba(128, 128, 128, .75)",
        hwaccel: !0,
      },
      Bc = { top: "auto", left: "auto", className: "" };
    !(function (a, b) {
      zc = b();
    })(this, function () {
      function a(a, c) {
        var d,
          e = b.createElement(a || "div");
        for (d in c) e[d] = c[d];
        return e;
      }
      function c(a) {
        for (var b = 1, c = arguments.length; c > b; b++)
          a.appendChild(arguments[b]);
        return a;
      }
      function d(a, b, c, d) {
        var e = ["opacity", b, ~~(100 * a), c, d].join("-"),
          f = 0.01 + (c / d) * 100,
          g = Math.max(1 - ((1 - a) / b) * (100 - f), a),
          h = m.substring(0, m.indexOf("Animation")).toLowerCase(),
          i = (h && "-" + h + "-") || "";
        return (
          o[e] ||
            (p.insertRule(
              "@" +
                i +
                "keyframes " +
                e +
                "{0%{opacity:" +
                g +
                "}" +
                f +
                "%{opacity:" +
                a +
                "}" +
                (f + 0.01) +
                "%{opacity:1}" +
                ((f + b) % 100) +
                "%{opacity:" +
                a +
                "}100%{opacity:" +
                g +
                "}}",
              p.cssRules.length
            ),
            (o[e] = 1)),
          e
        );
      }
      function f(a, b) {
        var c,
          d,
          f = a.style;
        for (
          b = b.charAt(0).toUpperCase() + b.slice(1), d = 0;
          d < n.length;
          d++
        )
          if (((c = n[d] + b), f[c] !== e)) return c;
        return f[b] !== e ? b : void 0;
      }
      function g(a, b) {
        for (var c in b) a.style[f(a, c) || c] = b[c];
        return a;
      }
      function h(a) {
        for (var b = 1; b < arguments.length; b++) {
          var c = arguments[b];
          for (var d in c) a[d] === e && (a[d] = c[d]);
        }
        return a;
      }
      function i(a) {
        for (
          var b = { x: a.offsetLeft, y: a.offsetTop };
          (a = a.offsetParent);

        )
          (b.x += a.offsetLeft), (b.y += a.offsetTop);
        return b;
      }
      function j(a, b) {
        return "string" == typeof a ? a : a[b % a.length];
      }
      function k(a) {
        return "undefined" == typeof this
          ? new k(a)
          : void (this.opts = h(a || {}, k.defaults, q));
      }
      function l() {
        function b(b, c) {
          return a(
            "<" +
              b +
              ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',
            c
          );
        }
        p.addRule(".spin-vml", "behavior:url(#default#VML)"),
          (k.prototype.lines = function (a, d) {
            function e() {
              return g(
                b("group", {
                  coordsize: k + " " + k,
                  coordorigin: -i + " " + -i,
                }),
                { width: k, height: k }
              );
            }
            function f(a, f, h) {
              c(
                m,
                c(
                  g(e(), { rotation: (360 / d.lines) * a + "deg", left: ~~f }),
                  c(
                    g(b("roundrect", { arcsize: d.corners }), {
                      width: i,
                      height: d.width,
                      left: d.radius,
                      top: -d.width >> 1,
                      filter: h,
                    }),
                    b("fill", { color: j(d.color, a), opacity: d.opacity }),
                    b("stroke", { opacity: 0 })
                  )
                )
              );
            }
            var h,
              i = d.length + d.width,
              k = 2 * i,
              l = 2 * -(d.width + d.length) + "px",
              m = g(e(), { position: "absolute", top: l, left: l });
            if (d.shadow)
              for (h = 1; h <= d.lines; h++)
                f(
                  h,
                  -2,
                  "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)"
                );
            for (h = 1; h <= d.lines; h++) f(h);
            return c(a, m);
          }),
          (k.prototype.opacity = function (a, b, c, d) {
            var e = a.firstChild;
            (d = (d.shadow && d.lines) || 0),
              e &&
                b + d < e.childNodes.length &&
                ((e = e.childNodes[b + d]),
                (e = e && e.firstChild),
                (e = e && e.firstChild),
                e && (e.opacity = c));
          });
      }
      var m,
        n = ["webkit", "Moz", "ms", "O"],
        o = {},
        p = (function () {
          var d = a("style", { type: "text/css" });
          return (
            c(b.getElementsByTagName("head")[0], d), d.sheet || d.styleSheet
          );
        })(),
        q = {
          lines: 12,
          length: 7,
          width: 5,
          radius: 10,
          rotate: 0,
          corners: 1,
          color: "#000",
          direction: 1,
          speed: 1,
          trail: 100,
          opacity: 0.25,
          fps: 20,
          zIndex: 2e9,
          className: "spinner",
          top: "auto",
          left: "auto",
          position: "relative",
        };
      (k.defaults = {}),
        h(k.prototype, {
          spin: function (b) {
            this.stop();
            var c,
              d,
              e = this,
              f = e.opts,
              h = (e.el = g(a(0, { className: f.className }), {
                position: f.position,
                width: 0,
                zIndex: f.zIndex,
              })),
              j = f.radius + f.length + f.width;
            if (
              (b &&
                (b.insertBefore(h, b.firstChild || null),
                (d = i(b)),
                (c = i(h)),
                g(h, {
                  left:
                    ("auto" == f.left
                      ? d.x - c.x + (b.offsetWidth >> 1)
                      : parseInt(f.left, 10) + j) + "px",
                  top:
                    ("auto" == f.top
                      ? d.y - c.y + (b.offsetHeight >> 1)
                      : parseInt(f.top, 10) + j) + "px",
                })),
              h.setAttribute("role", "progressbar"),
              e.lines(h, e.opts),
              !m)
            ) {
              var k,
                l = 0,
                n = ((f.lines - 1) * (1 - f.direction)) / 2,
                o = f.fps,
                p = o / f.speed,
                q = (1 - f.opacity) / ((p * f.trail) / 100),
                r = p / f.lines;
              !(function s() {
                l++;
                for (var a = 0; a < f.lines; a++)
                  (k = Math.max(
                    1 - ((l + (f.lines - a) * r) % p) * q,
                    f.opacity
                  )),
                    e.opacity(h, a * f.direction + n, k, f);
                e.timeout = e.el && setTimeout(s, ~~(1e3 / o));
              })();
            }
            return e;
          },
          stop: function () {
            var a = this.el;
            return (
              a &&
                (clearTimeout(this.timeout),
                a.parentNode && a.parentNode.removeChild(a),
                (this.el = e)),
              this
            );
          },
          lines: function (b, e) {
            function f(b, c) {
              return g(a(), {
                position: "absolute",
                width: e.length + e.width + "px",
                height: e.width + "px",
                background: b,
                boxShadow: c,
                transformOrigin: "left",
                transform:
                  "rotate(" +
                  ~~((360 / e.lines) * i + e.rotate) +
                  "deg) translate(" +
                  e.radius +
                  "px,0)",
                borderRadius: ((e.corners * e.width) >> 1) + "px",
              });
            }
            for (
              var h, i = 0, k = ((e.lines - 1) * (1 - e.direction)) / 2;
              i < e.lines;
              i++
            )
              (h = g(a(), {
                position: "absolute",
                top: 1 + ~(e.width / 2) + "px",
                transform: e.hwaccel ? "translate3d(0,0,0)" : "",
                opacity: e.opacity,
                animation:
                  m &&
                  d(e.opacity, e.trail, k + i * e.direction, e.lines) +
                    " " +
                    1 / e.speed +
                    "s linear infinite",
              })),
                e.shadow && c(h, g(f("#000", "0 0 4px #000"), { top: "2px" })),
                c(b, c(h, f(j(e.color, i), "0 0 1px rgba(0,0,0,.1)")));
            return b;
          },
          opacity: function (a, b, c) {
            b < a.childNodes.length && (a.childNodes[b].style.opacity = c);
          },
        });
      var r = g(a("group"), { behavior: "url(#default#VML)" });
      return !f(r, "transform") && r.adj ? l() : (m = f(r, "animation")), k;
    });
    var Cc,
      Dc,
      Ec = d(a),
      Fc = d(b),
      Gc = "quirks" === c.hash.replace("#", ""),
      Hc = uc.csstransforms3d,
      Ic = Hc && !Gc,
      Jc = Hc || "CSS1Compat" === b.compatMode,
      Kc = vc.ok,
      Lc = navigator.userAgent.match(
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i
      ),
      Mc = !Ic || Lc,
      Nc = navigator.msPointerEnabled,
      Oc =
        "onwheel" in b.createElement("div")
          ? "wheel"
          : b.onmousewheel !== e
          ? "mousewheel"
          : "DOMMouseScroll",
      Pc = 250,
      Qc = 300,
      Rc = 1400,
      Sc = 5e3,
      Tc = 2,
      Uc = 64,
      Vc = 500,
      Wc = 333,
      Xc = "$stageFrame",
      Yc = "$navDotFrame",
      Zc = "$navThumbFrame",
      $c = "auto",
      _c = f([0.1, 0, 0.25, 1]),
      ad = 99999,
      bd = "50%",
      cd = {
        width: null,
        minwidth: null,
        maxwidth: "100%",
        height: null,
        minheight: null,
        maxheight: null,
        ratio: null,
        margin: Tc,
        glimpse: 0,
        fit: "contain",
        position: bd,
        thumbposition: bd,
        nav: "dots",
        navposition: "bottom",
        navwidth: null,
        thumbwidth: Uc,
        thumbheight: Uc,
        thumbmargin: Tc,
        thumbborderwidth: Tc,
        thumbfit: "cover",
        allowfullscreen: !1,
        transition: "slide",
        clicktransition: null,
        transitionduration: Qc,
        captions: !0,
        hash: !1,
        startindex: 0,
        loop: !1,
        autoplay: !1,
        stopautoplayontouch: !0,
        keyboard: !1,
        arrows: !0,
        click: !0,
        swipe: !0,
        trackpad: !1,
        enableifsingleframe: !1,
        controlsonstart: !0,
        shuffle: !1,
        direction: "ltr",
        shadows: !0,
        spinner: null,
      },
      dd = {
        left: !0,
        right: !0,
        down: !1,
        up: !1,
        space: !1,
        home: !1,
        end: !1,
      };
    G.stop = function (a) {
      G.ii[a] = !1;
    };
    var ed, fd, gd, hd;
    (jQuery.Fotorama = function (a, e) {
      function f() {
        d.each(yd, function (a, b) {
          if (!b.i) {
            b.i = me++;
            var c = A(b.video, !0);
            if (c) {
              var d = {};
              (b.video = c),
                b.img || b.thumb ? (b.thumbsReady = !0) : (d = B(b, yd, ie)),
                C(yd, { img: d.img, thumb: d.thumb }, b.i, ie);
            }
          }
        });
      }
      function g(a) {
        return Zd[a] || ie.fullScreen;
      }
      function i(a) {
        var b = "keydown." + ib,
          c = ib + je,
          d = "keydown." + c,
          f = "resize." + c + " orientationchange." + c;
        a
          ? (Fc.on(d, function (a) {
              var b, c;
              Cd && 27 === a.keyCode
                ? ((b = !0), md(Cd, !0, !0))
                : (ie.fullScreen || (e.keyboard && !ie.index)) &&
                  (27 === a.keyCode
                    ? ((b = !0), ie.cancelFullScreen())
                    : (a.shiftKey && 32 === a.keyCode && g("space")) ||
                      (37 === a.keyCode && g("left")) ||
                      (38 === a.keyCode && g("up"))
                    ? (c = "<")
                    : (32 === a.keyCode && g("space")) ||
                      (39 === a.keyCode && g("right")) ||
                      (40 === a.keyCode && g("down"))
                    ? (c = ">")
                    : 36 === a.keyCode && g("home")
                    ? (c = "<<")
                    : 35 === a.keyCode && g("end") && (c = ">>")),
                (b || c) && Y(a),
                c && ie.show({ index: c, slow: a.altKey, user: !0 });
            }),
            ie.index ||
              Fc.off(b).on(b, "textarea, input, select", function (a) {
                !Dc.hasClass(jb) && a.stopPropagation();
              }),
            Ec.on(f, ie.resize))
          : (Fc.off(d), Ec.off(f));
      }
      function j(b) {
        b !== j.f &&
          (b
            ? (a
                .html("")
                .addClass(ib + " " + ke)
                .append(qe)
                .before(oe)
                .before(pe),
              gb(ie))
            : (qe.detach(),
              oe.detach(),
              pe.detach(),
              a.html(ne.urtext).removeClass(ke),
              hb(ie)),
          i(b),
          (j.f = b));
      }
      function m() {
        (yd = ie.data = yd || P(e.data) || D(a)),
          (zd = ie.size = yd.length),
          !xd.ok && e.shuffle && O(yd),
          f(),
          (Je = y(Je)),
          zd && j(!0);
      }
      function o() {
        var a = (2 > zd && !e.enableifsingleframe) || Cd;
        (Me.noMove = a || Sd),
          (Me.noSwipe = a || !e.swipe),
          !Wd && se.toggleClass(Bb, !e.click && !Me.noMove && !Me.noSwipe),
          Nc && qe.toggleClass(sb, !Me.noSwipe);
      }
      function t(a) {
        a === !0 && (a = ""), (e.autoplay = Math.max(+a || Sc, 1.5 * Vd));
      }
      function u() {
        function a(a, c) {
          b[a ? "add" : "remove"].push(c);
        }
        (ie.options = e = R(e)),
          (Sd = "crossfade" === e.transition || "dissolve" === e.transition),
          (Md = e.loop && (zd > 2 || (Sd && (!Wd || "slide" !== Wd)))),
          (Vd = +e.transitionduration || Qc),
          (Yd = "rtl" === e.direction),
          (Zd = d.extend({}, e.keyboard && dd, e.keyboard));
        var b = { add: [], remove: [] };
        zd > 1 || e.enableifsingleframe
          ? ((Nd = e.nav),
            (Pd = "top" === e.navposition),
            b.remove.push(Xb),
            we.toggle(!!e.arrows))
          : ((Nd = !1), we.hide()),
          Rb(),
          (Bd = new zc(
            d.extend(Ac, e.spinner, Bc, { direction: Yd ? -1 : 1 })
          )),
          Gc(),
          Hc(),
          e.autoplay && t(e.autoplay),
          (Td = n(e.thumbwidth) || Uc),
          (Ud = n(e.thumbheight) || Uc),
          (Ne.ok = Pe.ok = e.trackpad && !Mc),
          o(),
          ed(e, [Le]),
          (Od = "thumbs" === Nd),
          Od
            ? (lc(zd, "navThumb"),
              (Ad = Be),
              (he = Zc),
              J(
                oe,
                d.Fotorama.jst.style({
                  w: Td,
                  h: Ud,
                  b: e.thumbborderwidth,
                  m: e.thumbmargin,
                  s: je,
                  q: !Jc,
                })
              ),
              ye.addClass(Lb).removeClass(Kb))
            : "dots" === Nd
            ? (lc(zd, "navDot"),
              (Ad = Ae),
              (he = Yc),
              ye.addClass(Kb).removeClass(Lb))
            : ((Nd = !1), ye.removeClass(Lb + " " + Kb)),
          Nd &&
            (Pd ? xe.insertBefore(re) : xe.insertAfter(re),
            (wc.nav = !1),
            wc(Ad, ze, "nav")),
          (Qd = e.allowfullscreen),
          Qd
            ? (De.prependTo(re), (Rd = Kc && "native" === Qd))
            : (De.detach(), (Rd = !1)),
          a(Sd, ob),
          a(!Sd, pb),
          a(!e.captions, vb),
          a(Yd, tb),
          a("always" !== e.arrows, wb),
          (Xd = e.shadows && !Mc),
          a(!Xd, rb),
          qe.addClass(b.add.join(" ")).removeClass(b.remove.join(" ")),
          (Ke = d.extend({}, e));
      }
      function x(a) {
        return 0 > a ? (zd + (a % zd)) % zd : a >= zd ? a % zd : a;
      }
      function y(a) {
        return h(a, 0, zd - 1);
      }
      function z(a) {
        return Md ? x(a) : y(a);
      }
      function E(a) {
        return a > 0 || Md ? a - 1 : !1;
      }
      function U(a) {
        return zd - 1 > a || Md ? a + 1 : !1;
      }
      function $() {
        (Me.min = Md ? -1 / 0 : -r(zd - 1, Le.w, e.margin, Fd)),
          (Me.max = Md ? 1 / 0 : -r(0, Le.w, e.margin, Fd)),
          (Me.snap = Le.w + e.margin);
      }
      function bb() {
        (Oe.min = Math.min(0, Le.nw - ze.width())),
          (Oe.max = 0),
          ze.toggleClass(Bb, !(Oe.noMove = Oe.min === Oe.max));
      }
      function cb(a, b, c) {
        if ("number" == typeof a) {
          a = new Array(a);
          var e = !0;
        }
        return d.each(a, function (a, d) {
          if ((e && (d = a), "number" == typeof d)) {
            var f = yd[x(d)];
            if (f) {
              var g = "$" + b + "Frame",
                h = f[g];
              c.call(this, a, d, f, h, g, h && h.data());
            }
          }
        });
      }
      function fb(a, b, c, d) {
        (!$d || ("*" === $d && d === Ld)) &&
          ((a = q(e.width) || q(a) || Vc),
          (b = q(e.height) || q(b) || Wc),
          ie.resize(
            { width: a, ratio: e.ratio || c || a / b },
            0,
            d !== Ld && "*"
          ));
      }
      function Pb(a, b, c, f, g, h) {
        cb(a, b, function (a, i, j, k, l, m) {
          function n(a) {
            var b = x(i);
            fd(a, { index: b, src: w, frame: yd[b] });
          }
          function o() {
            t.remove(),
              (d.Fotorama.cache[w] = "error"),
              (j.html && "stage" === b) || !y || y === w
                ? (!w || j.html || r
                    ? "stage" === b &&
                      (k
                        .trigger("f:load")
                        .removeClass(ac + " " + _b)
                        .addClass(bc),
                      n("load"),
                      fb())
                    : (k.trigger("f:error").removeClass(ac).addClass(_b),
                      n("error")),
                  (m.state = "error"),
                  !(zd > 1 && yd[i] === j) ||
                    j.html ||
                    j.deleted ||
                    j.video ||
                    r ||
                    ((j.deleted = !0), ie.splice(i, 1)))
                : ((j[v] = w = y), Pb([i], b, c, f, g, !0));
          }
          function p() {
            (d.Fotorama.measures[w] = u.measures =
              d.Fotorama.measures[w] || {
                width: s.width,
                height: s.height,
                ratio: s.width / s.height,
              }),
              fb(u.measures.width, u.measures.height, u.measures.ratio, i),
              t
                .off("load error")
                .addClass(fc + (r ? " " + gc : ""))
                .prependTo(k),
              I(
                t,
                (d.isFunction(c) ? c() : c) || Le,
                f || j.fit || e.fit,
                g || j.position || e.position
              ),
              (d.Fotorama.cache[w] = m.state = "loaded"),
              setTimeout(function () {
                k
                  .trigger("f:load")
                  .removeClass(ac + " " + _b)
                  .addClass(bc + " " + (r ? cc : dc)),
                  "stage" === b
                    ? n("load")
                    : (j.thumbratio === $c ||
                        (!j.thumbratio && e.thumbratio === $c)) &&
                      ((j.thumbratio = u.measures.ratio), vd());
              }, 0);
          }
          function q() {
            var a = 10;
            G(
              function () {
                return !fe || (!a-- && !Mc);
              },
              function () {
                p();
              }
            );
          }
          if (k) {
            var r =
              ie.fullScreen &&
              j.full &&
              j.full !== j.img &&
              !m.$full &&
              "stage" === b;
            if (!m.$img || h || r) {
              var s = new Image(),
                t = d(s),
                u = t.data();
              m[r ? "$full" : "$img"] = t;
              var v = "stage" === b ? (r ? "full" : "img") : "thumb",
                w = j[v],
                y = r ? null : j["stage" === b ? "thumb" : "img"];
              if (("navThumb" === b && (k = m.$wrap), !w)) return void o();
              d.Fotorama.cache[w]
                ? !(function z() {
                    "error" === d.Fotorama.cache[w]
                      ? o()
                      : "loaded" === d.Fotorama.cache[w]
                      ? setTimeout(q, 0)
                      : setTimeout(z, 100);
                  })()
                : ((d.Fotorama.cache[w] = "*"), t.on("load", q).on("error", o)),
                (m.state = ""),
                (s.src = w);
            }
          }
        });
      }
      function Qb(a) {
        Ie.append(Bd.spin().el).appendTo(a);
      }
      function Rb() {
        Ie.detach(), Bd && Bd.stop();
      }
      function Sb() {
        var a = Dd[Xc];
        a &&
          !a.data().state &&
          (Qb(a),
          a.on("f:load f:error", function () {
            a.off("f:load f:error"), Rb();
          }));
      }
      function ec(a) {
        W(a, sd),
          X(a, function () {
            setTimeout(function () {
              Q(ye);
            }, 0),
              Rc({ time: Vd, guessIndex: d(this).data().eq, minMax: Oe });
          });
      }
      function lc(a, b) {
        cb(a, b, function (a, c, e, f, g, h) {
          if (!f) {
            (f = e[g] = qe[g].clone()), (h = f.data()), (h.data = e);
            var i = f[0];
            "stage" === b
              ? (e.html &&
                  d('<div class="' + kc + '"></div>')
                    .append(
                      e._html
                        ? d(e.html).removeAttr("id").html(e._html)
                        : e.html
                    )
                    .appendTo(f),
                e.caption && d(N(oc, N(pc, e.caption))).appendTo(f),
                e.video && f.addClass(zb).append(Fe.clone()),
                X(i, function () {
                  setTimeout(function () {
                    Q(re);
                  }, 0),
                    pd({ index: h.eq, user: !0 });
                }),
                (te = te.add(f)))
              : "navDot" === b
              ? (ec(i), (Ae = Ae.add(f)))
              : "navThumb" === b &&
                (ec(i),
                (h.$wrap = f.children(":first")),
                (Be = Be.add(f)),
                e.video && h.$wrap.append(Fe.clone()));
          }
        });
      }
      function sc(a, b, c, d) {
        return a && a.length && I(a, b, c, d);
      }
      function tc(a) {
        cb(a, "stage", function (a, b, c, f, g, h) {
          if (f) {
            var i = x(b),
              j = c.fit || e.fit,
              k = c.position || e.position;
            (h.eq = i),
              (Re[Xc][i] = f.css(
                d.extend(
                  { left: Sd ? 0 : r(b, Le.w, e.margin, Fd) },
                  Sd && l(0)
                )
              )),
              F(f[0]) && (f.appendTo(se), md(c.$video)),
              sc(h.$img, Le, j, k),
              sc(h.$full, Le, j, k);
          }
        });
      }
      function uc(a, b) {
        if ("thumbs" === Nd && !isNaN(a)) {
          var c = -a,
            f = -a + Le.nw;
          Be.each(function () {
            var a = d(this),
              g = a.data(),
              h = g.eq,
              i = function () {
                return { h: Ud, w: g.w };
              },
              j = i(),
              k = yd[h] || {},
              l = k.thumbfit || e.thumbfit,
              m = k.thumbposition || e.thumbposition;
            (j.w = g.w),
              g.l + g.w < c ||
                g.l > f ||
                sc(g.$img, j, l, m) ||
                (b && Pb([h], "navThumb", i, l, m));
          });
        }
      }
      function wc(a, b, c) {
        if (!wc[c]) {
          var f = "nav" === c && Od,
            g = 0;
          b.append(
            a
              .filter(function () {
                for (
                  var a, b = d(this), c = b.data(), e = 0, f = yd.length;
                  f > e;
                  e++
                )
                  if (c.data === yd[e]) {
                    (a = !0), (c.eq = e);
                    break;
                  }
                return a || (b.remove() && !1);
              })
              .sort(function (a, b) {
                return d(a).data().eq - d(b).data().eq;
              })
              .each(function () {
                if (f) {
                  var a = d(this),
                    b = a.data(),
                    c = Math.round(Ud * b.data.thumbratio) || Td;
                  (b.l = g),
                    (b.w = c),
                    a.css({ width: c }),
                    (g += c + e.thumbmargin);
                }
              })
          ),
            (wc[c] = !0);
        }
      }
      function xc(a) {
        return a - Se > Le.w / 3;
      }
      function yc(a) {
        return !(Md || (Je + a && Je - zd + a) || Cd);
      }
      function Gc() {
        var a = yc(0),
          b = yc(1);
        ue.toggleClass(Eb, a).attr(V(a)), ve.toggleClass(Eb, b).attr(V(b));
      }
      function Hc() {
        Ne.ok && (Ne.prevent = { "<": yc(0), ">": yc(1) });
      }
      function Lc(a) {
        var b,
          c,
          d = a.data();
        return (
          Od
            ? ((b = d.l), (c = d.w))
            : ((b = a.position().left), (c = a.width())),
          {
            c: b + c / 2,
            min: -b + 10 * e.thumbmargin,
            max: -b + Le.w - c - 10 * e.thumbmargin,
          }
        );
      }
      function Oc(a) {
        var b = Dd[he].data();
        _(Ce, { time: 1.2 * a, pos: b.l, width: b.w - 2 * e.thumbborderwidth });
      }
      function Rc(a) {
        var b = yd[a.guessIndex][he];
        if (b) {
          var c = Oe.min !== Oe.max,
            d = a.minMax || (c && Lc(Dd[he])),
            e =
              c &&
              (a.keep && Rc.l
                ? Rc.l
                : h((a.coo || Le.nw / 2) - Lc(b).c, d.min, d.max)),
            f = c && h(e, Oe.min, Oe.max),
            g = 1.1 * a.time;
          _(ze, {
            time: g,
            pos: f || 0,
            onEnd: function () {
              uc(f, !0);
            },
          }),
            ld(ye, K(f, Oe.min, Oe.max)),
            (Rc.l = e);
        }
      }
      function Tc() {
        _c(he), Qe[he].push(Dd[he].addClass(Wb));
      }
      function _c(a) {
        for (var b = Qe[a]; b.length; ) b.shift().removeClass(Wb);
      }
      function bd(a) {
        var b = Re[a];
        d.each(Ed, function (a, c) {
          delete b[x(c)];
        }),
          d.each(b, function (a, c) {
            delete b[a], c.detach();
          });
      }
      function cd(a) {
        Fd = Gd = Je;
        var b = Dd[Xc];
        b &&
          (_c(Xc),
          Qe[Xc].push(b.addClass(Wb)),
          a || ie.show.onEnd(!0),
          v(se, 0, !0),
          bd(Xc),
          tc(Ed),
          $(),
          bb());
      }
      function ed(a, b) {
        a &&
          d.each(b, function (b, c) {
            c &&
              d.extend(c, {
                width: a.width || c.width,
                height: a.height,
                minwidth: a.minwidth,
                maxwidth: a.maxwidth,
                minheight: a.minheight,
                maxheight: a.maxheight,
                ratio: S(a.ratio),
              });
          });
      }
      function fd(b, c) {
        a.trigger(ib + ":" + b, [ie, c]);
      }
      function gd() {
        clearTimeout(hd.t),
          (fe = 1),
          e.stopautoplayontouch ? ie.stopAutoplay() : (ce = !0);
      }
      function hd() {
        fe &&
          (e.stopautoplayontouch || (id(), jd()),
          (hd.t = setTimeout(function () {
            fe = 0;
          }, Qc + Pc)));
      }
      function id() {
        ce = !(!Cd && !de);
      }
      function jd() {
        if ((clearTimeout(jd.t), G.stop(jd.w), !e.autoplay || ce))
          return void (ie.autoplay && ((ie.autoplay = !1), fd("stopautoplay")));
        ie.autoplay || ((ie.autoplay = !0), fd("startautoplay"));
        var a = Je,
          b = Dd[Xc].data();
        jd.w = G(
          function () {
            return b.state || a !== Je;
          },
          function () {
            jd.t = setTimeout(function () {
              if (!ce && a === Je) {
                var b = Kd,
                  c = yd[b][Xc].data();
                jd.w = G(
                  function () {
                    return c.state || b !== Kd;
                  },
                  function () {
                    ce || b !== Kd || ie.show(Md ? Z(!Yd) : Kd);
                  }
                );
              }
            }, e.autoplay);
          }
        );
      }
      function kd() {
        ie.fullScreen &&
          ((ie.fullScreen = !1),
          Kc && vc.cancel(le),
          Dc.removeClass(jb),
          Cc.removeClass(jb),
          a.removeClass(Zb).insertAfter(pe),
          (Le = d.extend({}, ee)),
          md(Cd, !0, !0),
          rd("x", !1),
          ie.resize(),
          Pb(Ed, "stage"),
          Q(Ec, ae, _d),
          fd("fullscreenexit"));
      }
      function ld(a, b) {
        Xd &&
          (a.removeClass(Ub + " " + Vb),
          b && !Cd && a.addClass(b.replace(/^|\s/g, " " + Tb + "--")));
      }
      function md(a, b, c) {
        b && (qe.removeClass(nb), (Cd = !1), o()),
          a && a !== Cd && (a.remove(), fd("unloadvideo")),
          c && (id(), jd());
      }
      function nd(a) {
        qe.toggleClass(qb, a);
      }
      function od(a) {
        if (!Me.flow) {
          var b = a ? a.pageX : od.x,
            c = b && !yc(xc(b)) && e.click;
          od.p !== c && re.toggleClass(Cb, c) && ((od.p = c), (od.x = b));
        }
      }
      function pd(a) {
        clearTimeout(pd.t),
          e.clicktransition && e.clicktransition !== e.transition
            ? setTimeout(function () {
                var b = e.transition;
                ie.setOptions({ transition: e.clicktransition }),
                  (Wd = b),
                  (pd.t = setTimeout(function () {
                    ie.show(a);
                  }, 10));
              }, 0)
            : ie.show(a);
      }
      function qd(a, b) {
        var c = a.target,
          f = d(c);
        f.hasClass(mc)
          ? ie.playVideo()
          : c === Ee
          ? ie.toggleFullScreen()
          : Cd
          ? c === He && md(Cd, !0, !0)
          : b
          ? nd()
          : e.click &&
            pd({ index: a.shiftKey || Z(xc(a._x)), slow: a.altKey, user: !0 });
      }
      function rd(a, b) {
        Me[a] = Oe[a] = b;
      }
      function sd(a) {
        var b = d(this).data().eq;
        pd({
          index: b,
          slow: a.altKey,
          user: !0,
          coo: a._x - ye.offset().left,
        });
      }
      function td(a) {
        pd({ index: we.index(this) ? ">" : "<", slow: a.altKey, user: !0 });
      }
      function ud(a) {
        X(a, function () {
          setTimeout(function () {
            Q(re);
          }, 0),
            nd(!1);
        });
      }
      function vd() {
        if ((m(), u(), !vd.i)) {
          vd.i = !0;
          var a = e.startindex;
          (a || (e.hash && c.hash)) &&
            (Ld = L(a || c.hash.replace(/^#/, ""), yd, 0 === ie.index || a, a)),
            (Je = Fd = Gd = Hd = Ld = z(Ld) || 0);
        }
        if (zd) {
          if (wd()) return;
          Cd && md(Cd, !0),
            (Ed = []),
            bd(Xc),
            (vd.ok = !0),
            ie.show({ index: Je, time: 0 }),
            ie.resize();
        } else ie.destroy();
      }
      function wd() {
        return !wd.f === Yd
          ? ((wd.f = Yd), (Je = zd - 1 - Je), ie.reverse(), !0)
          : void 0;
      }
      function xd() {
        xd.ok || ((xd.ok = !0), fd("ready"));
      }
      (Cc = d("html")), (Dc = d("body"));
      var yd,
        zd,
        Ad,
        Bd,
        Cd,
        Dd,
        Ed,
        Fd,
        Gd,
        Hd,
        Id,
        Jd,
        Kd,
        Ld,
        Md,
        Nd,
        Od,
        Pd,
        Qd,
        Rd,
        Sd,
        Td,
        Ud,
        Vd,
        Wd,
        Xd,
        Yd,
        Zd,
        $d,
        _d,
        ae,
        be,
        ce,
        de,
        ee,
        fe,
        ge,
        he,
        ie = this,
        je = d.now(),
        ke = ib + je,
        le = a[0],
        me = 1,
        ne = a.data(),
        oe = d("<style></style>"),
        pe = d(N(Yb)),
        qe = d(N(kb)),
        re = d(N(xb)).appendTo(qe),
        se = (re[0], d(N(Ab)).appendTo(re)),
        te = d(),
        ue = d(N(Db + " " + Fb + rc)),
        ve = d(N(Db + " " + Gb + rc)),
        we = ue.add(ve).appendTo(re),
        xe = d(N(Ib)),
        ye = d(N(Hb)).appendTo(xe),
        ze = d(N(Jb)).appendTo(ye),
        Ae = d(),
        Be = d(),
        Ce = (se.data(), ze.data(), d(N(jc)).appendTo(ze)),
        De = d(N($b + rc)),
        Ee = De[0],
        Fe = d(N(mc)),
        Ge = d(N(nc)).appendTo(re),
        He = Ge[0],
        Ie = d(N(qc)),
        Je = !1,
        Ke = {},
        Le = {},
        Me = {},
        Ne = {},
        Oe = {},
        Pe = {},
        Qe = {},
        Re = {},
        Se = 0,
        Te = [];
      (qe[Xc] = d(N(yb))),
        (qe[Zc] = d(N(Mb + " " + Ob + rc, N(ic)))),
        (qe[Yc] = d(N(Mb + " " + Nb + rc, N(hc)))),
        (Qe[Xc] = []),
        (Qe[Zc] = []),
        (Qe[Yc] = []),
        (Re[Xc] = {}),
        qe.addClass(Ic ? mb : lb).toggleClass(qb, !e.controlsonstart),
        (ne.fotorama = this),
        (ie.startAutoplay = function (a) {
          return ie.autoplay
            ? this
            : ((ce = de = !1), t(a || e.autoplay), jd(), this);
        }),
        (ie.stopAutoplay = function () {
          return ie.autoplay && ((ce = de = !0), jd()), this;
        }),
        (ie.show = function (a) {
          var b;
          "object" != typeof a ? ((b = a), (a = {})) : (b = a.index),
            (b =
              ">" === b
                ? Gd + 1
                : "<" === b
                ? Gd - 1
                : "<<" === b
                ? 0
                : ">>" === b
                ? zd - 1
                : b),
            (b = isNaN(b) ? L(b, yd, !0) : b),
            (b = "undefined" == typeof b ? Je || 0 : b),
            (ie.activeIndex = Je = z(b)),
            (Id = E(Je)),
            (Jd = U(Je)),
            (Kd = x(Je + (Yd ? -1 : 1))),
            (Ed = [Je, Id, Jd]),
            (Gd = Md ? b : Je);
          var c = Math.abs(Hd - Gd),
            d = w(a.time, function () {
              return Math.min(Vd * (1 + (c - 1) / 12), 2 * Vd);
            }),
            f = a.overPos;
          a.slow && (d *= 10);
          var g = Dd;
          ie.activeFrame = Dd = yd[Je];
          var i = g === Dd && !a.user;
          md(Cd, Dd.i !== yd[x(Fd)].i),
            lc(Ed, "stage"),
            tc(Mc ? [Gd] : [Gd, E(Gd), U(Gd)]),
            rd("go", !0),
            i || fd("show", { user: a.user, time: d }),
            (ce = !0);
          var j = (ie.show.onEnd = function (b) {
            if (!j.ok) {
              if (
                ((j.ok = !0),
                b || cd(!0),
                i || fd("showend", { user: a.user }),
                !b && Wd && Wd !== e.transition)
              )
                return ie.setOptions({ transition: Wd }), void (Wd = !1);
              Sb(), Pb(Ed, "stage"), rd("go", !1), Hc(), od(), id(), jd();
            }
          });
          if (Sd) {
            var k = Dd[Xc],
              l = Je !== Hd ? yd[Hd][Xc] : null;
            ab(k, l, te, { time: d, method: e.transition, onEnd: j }, Te);
          } else
            _(se, {
              pos: -r(Gd, Le.w, e.margin, Fd),
              overPos: f,
              time: d,
              onEnd: j,
            });
          if ((Gc(), Nd)) {
            Tc();
            var m = y(Je + h(Gd - Hd, -1, 1));
            Rc({
              time: d,
              coo: m !== Je && a.coo,
              guessIndex: "undefined" != typeof a.coo ? m : Je,
              keep: i,
            }),
              Od && Oc(d);
          }
          return (
            (be = "undefined" != typeof Hd && Hd !== Je),
            (Hd = Je),
            e.hash && be && !ie.eq && H(Dd.id || Je + 1),
            this
          );
        }),
        (ie.requestFullScreen = function () {
          return (
            Qd &&
              !ie.fullScreen &&
              ((_d = Ec.scrollTop()),
              (ae = Ec.scrollLeft()),
              Q(Ec),
              rd("x", !0),
              (ee = d.extend({}, Le)),
              a.addClass(Zb).appendTo(Dc.addClass(jb)),
              Cc.addClass(jb),
              md(Cd, !0, !0),
              (ie.fullScreen = !0),
              Rd && vc.request(le),
              ie.resize(),
              Pb(Ed, "stage"),
              Sb(),
              fd("fullscreenenter")),
            this
          );
        }),
        (ie.cancelFullScreen = function () {
          return Rd && vc.is() ? vc.cancel(b) : kd(), this;
        }),
        (ie.toggleFullScreen = function () {
          return ie[(ie.fullScreen ? "cancel" : "request") + "FullScreen"]();
        }),
        T(b, vc.event, function () {
          !yd || vc.is() || Cd || kd();
        }),
        (ie.resize = function (a) {
          if (!yd) return this;
          var b = arguments[1] || 0,
            c = arguments[2];
          ed(
            ie.fullScreen
              ? {
                  width: "100%",
                  maxwidth: null,
                  minwidth: null,
                  height: "100%",
                  maxheight: null,
                  minheight: null,
                }
              : R(a),
            [Le, c || ie.fullScreen || e]
          );
          var d = Le.width,
            f = Le.height,
            g = Le.ratio,
            i = Ec.height() - (Nd ? ye.height() : 0);
          return (
            q(d) &&
              (qe
                .addClass(ub)
                .css({
                  width: d,
                  minWidth: Le.minwidth || 0,
                  maxWidth: Le.maxwidth || ad,
                }),
              (d = Le.W = Le.w = qe.width()),
              (Le.nw = (Nd && p(e.navwidth, d)) || d),
              e.glimpse && (Le.w -= Math.round(2 * (p(e.glimpse, d) || 0))),
              se.css({ width: Le.w, marginLeft: (Le.W - Le.w) / 2 }),
              (f = p(f, i)),
              (f = f || (g && d / g)),
              f &&
                ((d = Math.round(d)),
                (f = Le.h =
                  Math.round(h(f, p(Le.minheight, i), p(Le.maxheight, i)))),
                re.stop().animate({ width: d, height: f }, b, function () {
                  qe.removeClass(ub);
                }),
                cd(),
                Nd &&
                  (ye.stop().animate({ width: Le.nw }, b),
                  Rc({ guessIndex: Je, time: b, keep: !0 }),
                  Od && wc.nav && Oc(b)),
                ($d = c || !0),
                xd())),
            (Se = re.offset().left),
            this
          );
        }),
        (ie.setOptions = function (a) {
          return d.extend(e, a), vd(), this;
        }),
        (ie.shuffle = function () {
          return yd && O(yd) && vd(), this;
        }),
        (ie.destroy = function () {
          return (
            ie.cancelFullScreen(),
            ie.stopAutoplay(),
            (yd = ie.data = null),
            j(),
            (Ed = []),
            bd(Xc),
            (vd.ok = !1),
            this
          );
        }),
        (ie.playVideo = function () {
          var a = Dd,
            b = a.video,
            c = Je;
          return (
            "object" == typeof b &&
              a.videoReady &&
              (Rd && ie.fullScreen && ie.cancelFullScreen(),
              G(
                function () {
                  return !vc.is() || c !== Je;
                },
                function () {
                  c === Je &&
                    ((a.$video = a.$video || d(d.Fotorama.jst.video(b))),
                    a.$video.appendTo(a[Xc]),
                    qe.addClass(nb),
                    (Cd = a.$video),
                    o(),
                    we.blur(),
                    De.blur(),
                    fd("loadvideo"));
                }
              )),
            this
          );
        }),
        (ie.stopVideo = function () {
          return md(Cd, !0, !0), this;
        }),
        re.on("mousemove", od),
        (Me = db(se, {
          onStart: gd,
          onMove: function (a, b) {
            ld(re, b.edge);
          },
          onTouchEnd: hd,
          onEnd: function (a) {
            ld(re);
            var b =
              ((Nc && !ge) || a.touch) && e.arrows && "always" !== e.arrows;
            if (a.moved || (b && a.pos !== a.newPos && !a.control)) {
              var c = s(a.newPos, Le.w, e.margin, Fd);
              ie.show({
                index: c,
                time: Sd ? Vd : a.time,
                overPos: a.overPos,
                user: !0,
              });
            } else a.aborted || a.control || qd(a.startEvent, b);
          },
          timeLow: 1,
          timeHigh: 1,
          friction: 2,
          select: "." + Xb + ", ." + Xb + " *",
          $wrap: re,
        })),
        (Oe = db(ze, {
          onStart: gd,
          onMove: function (a, b) {
            ld(ye, b.edge);
          },
          onTouchEnd: hd,
          onEnd: function (a) {
            function b() {
              (Rc.l = a.newPos), id(), jd(), uc(a.newPos, !0);
            }
            if (a.moved)
              a.pos !== a.newPos
                ? ((ce = !0),
                  _(ze, {
                    time: a.time,
                    pos: a.newPos,
                    overPos: a.overPos,
                    onEnd: b,
                  }),
                  uc(a.newPos),
                  Xd && ld(ye, K(a.newPos, Oe.min, Oe.max)))
                : b();
            else {
              var c = a.$target.closest("." + Mb, ze)[0];
              c && sd.call(c, a.startEvent);
            }
          },
          timeLow: 0.5,
          timeHigh: 2,
          friction: 5,
          $wrap: ye,
        })),
        (Ne = eb(re, {
          shift: !0,
          onEnd: function (a, b) {
            gd(), hd(), ie.show({ index: b, slow: a.altKey });
          },
        })),
        (Pe = eb(ye, {
          onEnd: function (a, b) {
            gd(), hd();
            var c = v(ze) + 0.25 * b;
            ze.css(k(h(c, Oe.min, Oe.max))),
              Xd && ld(ye, K(c, Oe.min, Oe.max)),
              (Pe.prevent = { "<": c >= Oe.max, ">": c <= Oe.min }),
              clearTimeout(Pe.t),
              (Pe.t = setTimeout(function () {
                (Rc.l = c), uc(c, !0);
              }, Pc)),
              uc(c);
          },
        })),
        qe.hover(
          function () {
            setTimeout(function () {
              fe || nd(!(ge = !0));
            }, 0);
          },
          function () {
            ge && nd(!(ge = !1));
          }
        ),
        M(
          we,
          function (a) {
            Y(a), td.call(this, a);
          },
          {
            onStart: function () {
              gd(), (Me.control = !0);
            },
            onTouchEnd: hd,
          }
        ),
        we.each(function () {
          W(this, function (a) {
            td.call(this, a);
          }),
            ud(this);
        }),
        W(Ee, ie.toggleFullScreen),
        ud(Ee),
        d.each(
          "load push pop shift unshift reverse sort splice".split(" "),
          function (a, b) {
            ie[b] = function () {
              return (
                (yd = yd || []),
                "load" !== b
                  ? Array.prototype[b].apply(yd, arguments)
                  : arguments[0] &&
                    "object" == typeof arguments[0] &&
                    arguments[0].length &&
                    (yd = P(arguments[0])),
                vd(),
                ie
              );
            };
          }
        ),
        vd();
    }),
      (d.fn.fotorama = function (b) {
        return this.each(function () {
          var c = this,
            e = d(this),
            f = e.data(),
            g = f.fotorama;
          g
            ? g.setOptions(b, !0)
            : G(
                function () {
                  return !E(c);
                },
                function () {
                  (f.urtext = e.html()),
                    new d.Fotorama(
                      e,
                      d.extend({}, cd, a.fotoramaDefaults, b, f)
                    );
                }
              );
        });
      }),
      (d.Fotorama.instances = []),
      (d.Fotorama.cache = {}),
      (d.Fotorama.measures = {}),
      (d = d || {}),
      (d.Fotorama = d.Fotorama || {}),
      (d.Fotorama.jst = d.Fotorama.jst || {}),
      (d.Fotorama.jst.style = function (a) {
        {
          var b,
            c = "";
          tc.escape;
        }
        return (c +=
          ".fotorama" +
          (null == (b = a.s) ? "" : b) +
          " .fotorama__nav--thumbs .fotorama__nav__frame{\npadding:" +
          (null == (b = a.m) ? "" : b) +
          "px;\nheight:" +
          (null == (b = a.h) ? "" : b) +
          "px}\n.fotorama" +
          (null == (b = a.s) ? "" : b) +
          " .fotorama__thumb-border{\nheight:" +
          (null == (b = a.h - a.b * (a.q ? 0 : 2)) ? "" : b) +
          "px;\nborder-width:" +
          (null == (b = a.b) ? "" : b) +
          "px;\nmargin-top:" +
          (null == (b = a.m) ? "" : b) +
          "px}");
      }),
      (d.Fotorama.jst.video = function (a) {
        function b() {
          c += d.call(arguments, "");
        }
        var c = "",
          d = (tc.escape, Array.prototype.join);
        return (
          (c += '<div class="fotorama__video"><iframe src="'),
          b(
            ("youtube" == a.type
              ? a.p + "youtube.com/embed/" + a.id + "?autoplay=1"
              : "vimeo" == a.type
              ? a.p + "player.vimeo.com/video/" + a.id + "?autoplay=1&badge=0"
              : a.id) + (a.s && "custom" != a.type ? "&" + a.s : "")
          ),
          (c += '" frameborder="0" allowfullscreen></iframe></div>\n')
        );
      }),
      d(function () {
        d("." + ib + ':not([data-auto="false"])').fotorama();
      });
  })(window, document, location, "undefined" != typeof jQuery && jQuery);
