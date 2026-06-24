;(function(window) {

  var svgSprite = '<svg>' +
    '' +
    '<symbol id="icon-14" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M510.528512 305.33632C395.805696 33.86368 66.403328 167.896064 66.403328 435.961856c-2.271232 172.65152 155.614208 293.054464 260.114432 362.341376 102.227968 67.016704 172.65152 98.82112 185.146368 98.82112 13.630464 0 90.86976-34.076672 184.010752-99.956736 103.364608-73.831424 262.385664-189.689856 261.249024-363.478016C956.923904 162.21696 628.658176 36.135936 510.528512 305.33632zM905.94304 441.216c0.946176 144.671744-127.164416 235.69408-220.705792 302.1568-4.496384 3.19488-8.906752 6.32832-13.154304 9.362432-84.117504 59.498496-147.91168 90.326016-160.328704 93.118464-12.145664-2.932736-69.697536-31.865856-161.938432-92.335104-52.834304-35.03104-108.215296-73.416704-153.603072-123.4176-53.916672-59.396096-79.702016-120.46336-78.830592-186.691584l0.001024-0.201728c0-155.05408 96.093184-236.181504 191.015936-236.181504 38.448128 0 75.583488 13.012992 107.389952 37.634048 35.207168 27.251712 62.971904 68.461568 80.293888 119.176192l13.288448 38.90688 15.476736-38.089728c21.059584-51.827712 51.646464-93.912064 88.454144-121.703424 33.286144-25.131008 71.033856-38.41536 109.162496-38.41536 48.32256 0 93.21984 21.161984 126.420992 59.587584C886.212608 307.32288 905.94304 368.526336 905.94304 441.216z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-xihuan" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M704.004477 124.640742c-74.442456 0-148.627039 33.120328-196.407252 87.968517-47.745421-54.848189-113.125477-87.968517-187.593516-87.968517-139.306766 0-252.630764 111.132076-252.630764 247.720941 0 222.305085 206.957539 361.722368 343.891258 453.981608 34.504862 23.232121 56.45478 37.229926 78.723969 55.406914l17.609053 17.609053 17.609053-17.609053c22.251793-18.176988 53.032844-32.17377 87.528496-55.42431 136.951115-92.240821 343.891258-231.6755 343.891258-453.963189C956.626032 235.772818 843.293847 124.640742 704.004477 124.640742z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-123-copy" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M576.968 463.869c0 36.586-29.651 66.235-66.235 66.235s-66.235-29.651-66.235-66.235 29.651-66.235 66.235-66.235 66.235 29.651 66.235 66.235z"  ></path>' +
    '' +
    '<path d="M321.392 463.869c0 36.586-29.651 66.235-66.235 66.235-36.638 0-66.287-29.651-66.287-66.235s29.651-66.235 66.287-66.235c36.586 0 66.235 29.651 66.235 66.235z"  ></path>' +
    '' +
    '<path d="M832.596 463.869c0 36.586-29.651 66.235-66.235 66.235s-66.235-29.651-66.235-66.235 29.652-66.235 66.235-66.235c36.586 0 66.235 29.651 66.235 66.235z"  ></path>' +
    '' +
    '<path d="M510.732 987.594c-16.499 0-32.764-5.574-45.799-15.697l-180.657-140.589h-182.265c-41.131 0-74.592-33.457-74.592-74.58v-583.041c0-41.123 33.462-74.58 74.592-74.58h817.465c41.116 0 74.566 33.456 74.566 74.58v583.041c0 41.123-33.452 74.58-74.566 74.58h-182.265l-180.663 140.573c-13.051 10.138-29.315 15.713-45.819 15.713zM102.013 152.097c-11.914 0-21.605 9.686-21.605 21.591v583.041c0 11.905 9.692 21.591 21.605 21.591h191.359c5.894 0 11.619 1.965 16.271 5.585l187.813 146.159c3.82 2.966 8.416 4.544 13.276 4.544 4.859 0 9.455-1.575 13.293-4.557l187.825-146.144c4.654-3.619 10.377-5.585 16.27-5.585h191.361c11.898 0 21.578-9.686 21.578-21.591v-583.042c0-11.905-9.681-21.591-21.578-21.591h-817.465z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '</svg>'
  var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
  var shouldInjectCss = script.getAttribute("data-injectcss")

  /**
   * document ready
   */
  var ready = function(fn) {
    if (document.addEventListener) {
      if (~["complete", "loaded", "interactive"].indexOf(document.readyState)) {
        setTimeout(fn, 0)
      } else {
        var loadFn = function() {
          document.removeEventListener("DOMContentLoaded", loadFn, false)
          fn()
        }
        document.addEventListener("DOMContentLoaded", loadFn, false)
      }
    } else if (document.attachEvent) {
      IEContentLoaded(window, fn)
    }

    function IEContentLoaded(w, fn) {
      var d = w.document,
        done = false,
        // only fire once
        init = function() {
          if (!done) {
            done = true
            fn()
          }
        }
        // polling for no errors
      var polling = function() {
        try {
          // throws errors until after ondocumentready
          d.documentElement.doScroll('left')
        } catch (e) {
          setTimeout(polling, 50)
          return
        }
        // no errors, fire

        init()
      };

      polling()
        // trying to always fire before onload
      d.onreadystatechange = function() {
        if (d.readyState == 'complete') {
          d.onreadystatechange = null
          init()
        }
      }
    }
  }

  /**
   * Insert el before target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var before = function(el, target) {
    target.parentNode.insertBefore(el, target)
  }

  /**
   * Prepend el to target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var prepend = function(el, target) {
    if (target.firstChild) {
      before(el, target.firstChild)
    } else {
      target.appendChild(el)
    }
  }

  function appendSvg() {
    var div, svg

    div = document.createElement('div')
    div.innerHTML = svgSprite
    svgSprite = null
    svg = div.getElementsByTagName('svg')[0]
    if (svg) {
      svg.setAttribute('aria-hidden', 'true')
      svg.style.position = 'absolute'
      svg.style.width = 0
      svg.style.height = 0
      svg.style.overflow = 'hidden'
      prepend(svg, document.body)
    }
  }

  if (shouldInjectCss && !window.__iconfont__svg__cssinject__) {
    window.__iconfont__svg__cssinject__ = true
    try {
      document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
    } catch (e) {
      console && console.log(e)
    }
  }

  ready(appendSvg)


})(window)