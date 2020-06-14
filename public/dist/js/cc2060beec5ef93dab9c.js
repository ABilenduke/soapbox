(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/articles/view.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _store_mutation_types__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ~/store/mutation-types */ \"./resources/js/store/mutation-types.js\");\n\n\nfunction asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }\n\nfunction _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"next\", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"throw\", err); } _next(undefined); }); }; }\n\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: \"ArticleView\",\n  data: function data() {\n    return {\n      articleId: null,\n      article: null,\n      content: null\n    };\n  },\n  created: function created() {\n    var _this = this;\n\n    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _this.articleId = _this.$route.params.articleId;\n              _context.next = 3;\n              return axios__WEBPACK_IMPORTED_MODULE_1___default.a.get(\"/api/article/\".concat(_this.articleId)).then(function (_ref) {\n                var data = _ref.data;\n                _this.article = data.article;\n              })[\"catch\"](function () {\n                _this.$store.commit(\"flash/\".concat(_store_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"ADD_MESSAGE\"]), {\n                  level: \"warning\",\n                  body: _this.$t(\"articleNotFound\"),\n                  isAutoRemove: true\n                });\n              });\n\n            case 3:\n              _context.next = 5;\n              return axios__WEBPACK_IMPORTED_MODULE_1___default.a.get(\"/api/article/\".concat(_this.articleId, \"/content\")).then(function (_ref2) {\n                var data = _ref2.data;\n                _this.content = data.content;\n              })[\"catch\"](function () {\n                _this.$store.commit(\"flash/\".concat(_store_mutation_types__WEBPACK_IMPORTED_MODULE_2__[\"ADD_MESSAGE\"]), {\n                  level: \"warning\",\n                  body: _this.$t(\"articleContentNotFound\"),\n                  isAutoRemove: true\n                });\n              });\n\n            case 5:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }))();\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vcmVzb3VyY2VzL2pzL3BhZ2VzL2FydGljbGVzL3ZpZXcudnVlP2E2ZDEiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQStDQTtBQUNBO0FBRUE7QUFDQSxxQkFEQTtBQUVBO0FBQUE7QUFDQSxxQkFEQTtBQUVBLG1CQUZBO0FBR0E7QUFIQTtBQUFBLEdBRkE7QUFPQSxTQVBBLHFCQU9BO0FBQUE7O0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBREE7QUFBQSxxQkFHQSw2Q0FDQSxHQURBLHdCQUNBLGVBREEsR0FFQSxJQUZBLENBRUE7QUFBQTtBQUNBO0FBQ0EsZUFKQSxXQUtBO0FBQ0E7QUFDQSxrQ0FEQTtBQUVBLG1EQUZBO0FBR0E7QUFIQTtBQUtBLGVBWEEsQ0FIQTs7QUFBQTtBQUFBO0FBQUEscUJBZ0JBLDZDQUNBLEdBREEsd0JBQ0EsZUFEQSxlQUVBLElBRkEsQ0FFQTtBQUFBO0FBQ0E7QUFDQSxlQUpBLFdBS0E7QUFDQTtBQUNBLGtDQURBO0FBRUEsMERBRkE7QUFHQTtBQUhBO0FBS0EsZUFYQSxDQWhCQTs7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQTRCQTtBQW5DQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPyEuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8hLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmLmpzIiwic291cmNlc0NvbnRlbnQiOlsiPHRlbXBsYXRlPlxuICA8di1jb250YWluZXIgdi1pZj1cImFydGljbGVcIj5cbiAgICA8di1yb3c+XG4gICAgICA8di1jb2w+XG4gICAgICAgIDx2LWltZyA6c3JjPVwiYC9zdG9yYWdlLyR7YXJ0aWNsZS5jb3ZlckltYWdlfWBcIiBjb250YWluIDphc3BlY3QtcmF0aW89XCIxNiAvIDlcIiAvPlxuICAgICAgPC92LWNvbD5cbiAgICA8L3Ytcm93PlxuXG4gICAgPHYtcm93PlxuICAgICAgPHYtY29sPlxuICAgICAgICA8aDQ+e3sgJHQoJ3RpdGxlJykgfX08L2g0PlxuICAgICAgICA8aDU+XG4gICAgICAgICAge3sgYXJ0aWNsZS50aXRsZSB9fVxuICAgICAgICA8L2g1PlxuICAgICAgPC92LWNvbD5cbiAgICA8L3Ytcm93PlxuXG4gICAgPHYtcm93PlxuICAgICAgPHYtY29sPlxuICAgICAgICA8aDQ+e3sgJHQoJ3N1YnRpdGxlJykgfX08L2g0PlxuICAgICAgICA8aDU+XG4gICAgICAgICAge3sgYXJ0aWNsZS5zdWJ0aXRsZSB9fVxuICAgICAgICA8L2g1PlxuICAgICAgPC92LWNvbD5cbiAgICA8L3Ytcm93PlxuXG4gICAgPHYtcm93PlxuICAgICAgPHYtY29sPlxuICAgICAgICA8aDQ+e3sgJHQoJ2Rlc2NyaXB0aW9uJykgfX08L2g0PlxuICAgICAgICA8cD57eyBhcnRpY2xlLmRlc2NyaXB0aW9uIH19PC9wPlxuICAgICAgPC92LWNvbD5cbiAgICA8L3Ytcm93PlxuXG4gICAgPHYtcm93XG4gICAgICB2LWZvcj1cIihzZWN0aW9uLCBpbmRleCkgaW4gY29udGVudFwiXG4gICAgICA6a2V5PVwiYGFydGljbGUtY29udGVudC0ke2luZGV4fWBcIlxuICAgICAgY2xhc3M9XCJwYS0zXCJcbiAgICA+XG4gICAgICA8di1jb2wgY2xhc3M9XCJ3eXNpd3lnLWNvbnRhaW5lclwiPlxuICAgICAgICA8ZGl2IHYtaHRtbD1cInNlY3Rpb24uY29udGVudFwiPlxuICAgICAgICA8L2Rpdj5cbiAgICAgIDwvdi1jb2w+XG4gICAgPC92LXJvdz5cbiAgPC92LWNvbnRhaW5lcj5cbjwvdGVtcGxhdGU+XG5cbjxzY3JpcHQ+XG5pbXBvcnQgYXhpb3MgZnJvbSAnYXhpb3MnXG5pbXBvcnQgeyBBRERfTUVTU0FHRSB9IGZyb20gJ34vc3RvcmUvbXV0YXRpb24tdHlwZXMnXG5cbmV4cG9ydCBkZWZhdWx0IHtcbiAgbmFtZTogXCJBcnRpY2xlVmlld1wiLFxuICBkYXRhOiAoKSA9PiAoe1xuICAgIGFydGljbGVJZDogbnVsbCxcbiAgICBhcnRpY2xlOiBudWxsLFxuICAgIGNvbnRlbnQ6IG51bGxcbiAgfSksXG4gIGFzeW5jIGNyZWF0ZWQoKSB7XG4gICAgdGhpcy5hcnRpY2xlSWQgPSB0aGlzLiRyb3V0ZS5wYXJhbXMuYXJ0aWNsZUlkO1xuXG4gICAgYXdhaXQgYXhpb3NcbiAgICAgIC5nZXQoYC9hcGkvYXJ0aWNsZS8ke3RoaXMuYXJ0aWNsZUlkfWApXG4gICAgICAudGhlbigoeyBkYXRhIH0pID0+IHtcbiAgICAgICAgdGhpcy5hcnRpY2xlID0gZGF0YS5hcnRpY2xlO1xuICAgICAgfSlcbiAgICAgIC5jYXRjaCgoKSA9PiB7XG4gICAgICAgIHRoaXMuJHN0b3JlLmNvbW1pdChgZmxhc2gvJHtBRERfTUVTU0FHRX1gLCB7XG4gICAgICAgICAgbGV2ZWw6IFwid2FybmluZ1wiLFxuICAgICAgICAgIGJvZHk6IHRoaXMuJHQoXCJhcnRpY2xlTm90Rm91bmRcIiksXG4gICAgICAgICAgaXNBdXRvUmVtb3ZlOiB0cnVlXG4gICAgICAgIH0pO1xuICAgICAgfSk7XG5cbiAgICBhd2FpdCBheGlvc1xuICAgICAgLmdldChgL2FwaS9hcnRpY2xlLyR7dGhpcy5hcnRpY2xlSWR9L2NvbnRlbnRgKVxuICAgICAgLnRoZW4oKHsgZGF0YSB9KSA9PiB7XG4gICAgICAgIHRoaXMuY29udGVudCA9IGRhdGEuY29udGVudDtcbiAgICAgIH0pXG4gICAgICAuY2F0Y2goKCkgPT4ge1xuICAgICAgICB0aGlzLiRzdG9yZS5jb21taXQoYGZsYXNoLyR7QUREX01FU1NBR0V9YCwge1xuICAgICAgICAgIGxldmVsOiBcIndhcm5pbmdcIixcbiAgICAgICAgICBib2R5OiB0aGlzLiR0KFwiYXJ0aWNsZUNvbnRlbnROb3RGb3VuZFwiKSxcbiAgICAgICAgICBpc0F1dG9SZW1vdmU6IHRydWVcbiAgICAgICAgfSk7XG4gICAgICB9KTtcbiAgfVxufTtcbjwvc2NyaXB0PiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _vm.article\n    ? _c(\n        \"v-container\",\n        [\n          _c(\n            \"v-row\",\n            [\n              _c(\n                \"v-col\",\n                [\n                  _c(\"v-img\", {\n                    attrs: {\n                      src: \"/storage/\" + _vm.article.coverImage,\n                      contain: \"\",\n                      \"aspect-ratio\": 16 / 9\n                    }\n                  })\n                ],\n                1\n              )\n            ],\n            1\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"v-row\",\n            [\n              _c(\"v-col\", [\n                _c(\"h4\", [_vm._v(_vm._s(_vm.$t(\"title\")))]),\n                _vm._v(\" \"),\n                _c(\"h5\", [\n                  _vm._v(\"\\n        \" + _vm._s(_vm.article.title) + \"\\n      \")\n                ])\n              ])\n            ],\n            1\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"v-row\",\n            [\n              _c(\"v-col\", [\n                _c(\"h4\", [_vm._v(_vm._s(_vm.$t(\"subtitle\")))]),\n                _vm._v(\" \"),\n                _c(\"h5\", [\n                  _vm._v(\n                    \"\\n        \" + _vm._s(_vm.article.subtitle) + \"\\n      \"\n                  )\n                ])\n              ])\n            ],\n            1\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"v-row\",\n            [\n              _c(\"v-col\", [\n                _c(\"h4\", [_vm._v(_vm._s(_vm.$t(\"description\")))]),\n                _vm._v(\" \"),\n                _c(\"p\", [_vm._v(_vm._s(_vm.article.description))])\n              ])\n            ],\n            1\n          ),\n          _vm._v(\" \"),\n          _vm._l(_vm.content, function(section, index) {\n            return _c(\n              \"v-row\",\n              { key: \"article-content-\" + index, staticClass: \"pa-3\" },\n              [\n                _c(\"v-col\", { staticClass: \"wysiwyg-container\" }, [\n                  _c(\"div\", {\n                    domProps: { innerHTML: _vm._s(section.content) }\n                  })\n                ])\n              ],\n              1\n            )\n          })\n        ],\n        2\n      )\n    : _vm._e()\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/MTRjZiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsbUJBQW1CO0FBQ25CO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsZUFBZSx1REFBdUQ7QUFDdEU7QUFDQSw2QkFBNkIsbUNBQW1DO0FBQ2hFO0FBQ0EsK0JBQStCO0FBQy9CLG1CQUFtQjtBQUNuQjtBQUNBO0FBQ0E7QUFDQTtBQUNBLFdBQVc7QUFDWDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9sb2FkZXJzL3RlbXBsYXRlTG9hZGVyLmpzPyEuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8hLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9MmU2NjhkMWUmLmpzIiwic291cmNlc0NvbnRlbnQiOlsidmFyIHJlbmRlciA9IGZ1bmN0aW9uKCkge1xuICB2YXIgX3ZtID0gdGhpc1xuICB2YXIgX2ggPSBfdm0uJGNyZWF0ZUVsZW1lbnRcbiAgdmFyIF9jID0gX3ZtLl9zZWxmLl9jIHx8IF9oXG4gIHJldHVybiBfdm0uYXJ0aWNsZVxuICAgID8gX2MoXG4gICAgICAgIFwidi1jb250YWluZXJcIixcbiAgICAgICAgW1xuICAgICAgICAgIF9jKFxuICAgICAgICAgICAgXCJ2LXJvd1wiLFxuICAgICAgICAgICAgW1xuICAgICAgICAgICAgICBfYyhcbiAgICAgICAgICAgICAgICBcInYtY29sXCIsXG4gICAgICAgICAgICAgICAgW1xuICAgICAgICAgICAgICAgICAgX2MoXCJ2LWltZ1wiLCB7XG4gICAgICAgICAgICAgICAgICAgIGF0dHJzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgc3JjOiBcIi9zdG9yYWdlL1wiICsgX3ZtLmFydGljbGUuY292ZXJJbWFnZSxcbiAgICAgICAgICAgICAgICAgICAgICBjb250YWluOiBcIlwiLFxuICAgICAgICAgICAgICAgICAgICAgIFwiYXNwZWN0LXJhdGlvXCI6IDE2IC8gOVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIF0sXG4gICAgICAgICAgICAgICAgMVxuICAgICAgICAgICAgICApXG4gICAgICAgICAgICBdLFxuICAgICAgICAgICAgMVxuICAgICAgICAgICksXG4gICAgICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgICAgICBfYyhcbiAgICAgICAgICAgIFwidi1yb3dcIixcbiAgICAgICAgICAgIFtcbiAgICAgICAgICAgICAgX2MoXCJ2LWNvbFwiLCBbXG4gICAgICAgICAgICAgICAgX2MoXCJoNFwiLCBbX3ZtLl92KF92bS5fcyhfdm0uJHQoXCJ0aXRsZVwiKSkpXSksXG4gICAgICAgICAgICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgICAgICAgICAgICBfYyhcImg1XCIsIFtcbiAgICAgICAgICAgICAgICAgIF92bS5fdihcIlxcbiAgICAgICAgXCIgKyBfdm0uX3MoX3ZtLmFydGljbGUudGl0bGUpICsgXCJcXG4gICAgICBcIilcbiAgICAgICAgICAgICAgICBdKVxuICAgICAgICAgICAgICBdKVxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIDFcbiAgICAgICAgICApLFxuICAgICAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICAgICAgX2MoXG4gICAgICAgICAgICBcInYtcm93XCIsXG4gICAgICAgICAgICBbXG4gICAgICAgICAgICAgIF9jKFwidi1jb2xcIiwgW1xuICAgICAgICAgICAgICAgIF9jKFwiaDRcIiwgW192bS5fdihfdm0uX3MoX3ZtLiR0KFwic3VidGl0bGVcIikpKV0pLFxuICAgICAgICAgICAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICAgICAgICAgICAgX2MoXCJoNVwiLCBbXG4gICAgICAgICAgICAgICAgICBfdm0uX3YoXG4gICAgICAgICAgICAgICAgICAgIFwiXFxuICAgICAgICBcIiArIF92bS5fcyhfdm0uYXJ0aWNsZS5zdWJ0aXRsZSkgKyBcIlxcbiAgICAgIFwiXG4gICAgICAgICAgICAgICAgICApXG4gICAgICAgICAgICAgICAgXSlcbiAgICAgICAgICAgICAgXSlcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICAxXG4gICAgICAgICAgKSxcbiAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgIF9jKFxuICAgICAgICAgICAgXCJ2LXJvd1wiLFxuICAgICAgICAgICAgW1xuICAgICAgICAgICAgICBfYyhcInYtY29sXCIsIFtcbiAgICAgICAgICAgICAgICBfYyhcImg0XCIsIFtfdm0uX3YoX3ZtLl9zKF92bS4kdChcImRlc2NyaXB0aW9uXCIpKSldKSxcbiAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgIF9jKFwicFwiLCBbX3ZtLl92KF92bS5fcyhfdm0uYXJ0aWNsZS5kZXNjcmlwdGlvbikpXSlcbiAgICAgICAgICAgICAgXSlcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICAxXG4gICAgICAgICAgKSxcbiAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgIF92bS5fbChfdm0uY29udGVudCwgZnVuY3Rpb24oc2VjdGlvbiwgaW5kZXgpIHtcbiAgICAgICAgICAgIHJldHVybiBfYyhcbiAgICAgICAgICAgICAgXCJ2LXJvd1wiLFxuICAgICAgICAgICAgICB7IGtleTogXCJhcnRpY2xlLWNvbnRlbnQtXCIgKyBpbmRleCwgc3RhdGljQ2xhc3M6IFwicGEtM1wiIH0sXG4gICAgICAgICAgICAgIFtcbiAgICAgICAgICAgICAgICBfYyhcInYtY29sXCIsIHsgc3RhdGljQ2xhc3M6IFwid3lzaXd5Zy1jb250YWluZXJcIiB9LCBbXG4gICAgICAgICAgICAgICAgICBfYyhcImRpdlwiLCB7XG4gICAgICAgICAgICAgICAgICAgIGRvbVByb3BzOiB7IGlubmVySFRNTDogX3ZtLl9zKHNlY3Rpb24uY29udGVudCkgfVxuICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICBdKVxuICAgICAgICAgICAgICBdLFxuICAgICAgICAgICAgICAxXG4gICAgICAgICAgICApXG4gICAgICAgICAgfSlcbiAgICAgICAgXSxcbiAgICAgICAgMlxuICAgICAgKVxuICAgIDogX3ZtLl9lKClcbn1cbnZhciBzdGF0aWNSZW5kZXJGbnMgPSBbXVxucmVuZGVyLl93aXRoU3RyaXBwZWQgPSB0cnVlXG5cbmV4cG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&\n");

/***/ }),

/***/ "./resources/js/pages/articles/view.vue":
/*!**********************************************!*\
  !*** ./resources/js/pages/articles/view.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./view.vue?vue&type=template&id=2e668d1e& */ \"./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&\");\n/* harmony import */ var _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./view.vue?vue&type=script&lang=js& */ \"./resources/js/pages/articles/view.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"resources/js/pages/articles/view.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/MmUxMiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFtRjtBQUMzQjtBQUNMOzs7QUFHbkQ7QUFDZ0c7QUFDaEcsZ0JBQWdCLDJHQUFVO0FBQzFCLEVBQUUsMEVBQU07QUFDUixFQUFFLCtFQUFNO0FBQ1IsRUFBRSx3RkFBZTtBQUNqQjtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBLElBQUksS0FBVSxFQUFFLFlBaUJmO0FBQ0Q7QUFDZSxnRiIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9wYWdlcy9hcnRpY2xlcy92aWV3LnZ1ZS5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHJlbmRlciwgc3RhdGljUmVuZGVyRm5zIH0gZnJvbSBcIi4vdmlldy52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9MmU2NjhkMWUmXCJcbmltcG9ydCBzY3JpcHQgZnJvbSBcIi4vdmlldy52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcbmV4cG9ydCAqIGZyb20gXCIuL3ZpZXcudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiXG5cblxuLyogbm9ybWFsaXplIGNvbXBvbmVudCAqL1xuaW1wb3J0IG5vcm1hbGl6ZXIgZnJvbSBcIiEuLi8uLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvcnVudGltZS9jb21wb25lbnROb3JtYWxpemVyLmpzXCJcbnZhciBjb21wb25lbnQgPSBub3JtYWxpemVyKFxuICBzY3JpcHQsXG4gIHJlbmRlcixcbiAgc3RhdGljUmVuZGVyRm5zLFxuICBmYWxzZSxcbiAgbnVsbCxcbiAgbnVsbCxcbiAgbnVsbFxuICBcbilcblxuLyogaG90IHJlbG9hZCAqL1xuaWYgKG1vZHVsZS5ob3QpIHtcbiAgdmFyIGFwaSA9IHJlcXVpcmUoXCIvdmFyL3d3dy9odG1sL25vZGVfbW9kdWxlcy92dWUtaG90LXJlbG9hZC1hcGkvZGlzdC9pbmRleC5qc1wiKVxuICBhcGkuaW5zdGFsbChyZXF1aXJlKCd2dWUnKSlcbiAgaWYgKGFwaS5jb21wYXRpYmxlKSB7XG4gICAgbW9kdWxlLmhvdC5hY2NlcHQoKVxuICAgIGlmICghYXBpLmlzUmVjb3JkZWQoJzJlNjY4ZDFlJykpIHtcbiAgICAgIGFwaS5jcmVhdGVSZWNvcmQoJzJlNjY4ZDFlJywgY29tcG9uZW50Lm9wdGlvbnMpXG4gICAgfSBlbHNlIHtcbiAgICAgIGFwaS5yZWxvYWQoJzJlNjY4ZDFlJywgY29tcG9uZW50Lm9wdGlvbnMpXG4gICAgfVxuICAgIG1vZHVsZS5ob3QuYWNjZXB0KFwiLi92aWV3LnZ1ZT92dWUmdHlwZT10ZW1wbGF0ZSZpZD0yZTY2OGQxZSZcIiwgZnVuY3Rpb24gKCkge1xuICAgICAgYXBpLnJlcmVuZGVyKCcyZTY2OGQxZScsIHtcbiAgICAgICAgcmVuZGVyOiByZW5kZXIsXG4gICAgICAgIHN0YXRpY1JlbmRlckZuczogc3RhdGljUmVuZGVyRm5zXG4gICAgICB9KVxuICAgIH0pXG4gIH1cbn1cbmNvbXBvbmVudC5vcHRpb25zLl9fZmlsZSA9IFwicmVzb3VyY2VzL2pzL3BhZ2VzL2FydGljbGVzL3ZpZXcudnVlXCJcbmV4cG9ydCBkZWZhdWx0IGNvbXBvbmVudC5leHBvcnRzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/pages/articles/view.vue\n");

/***/ }),

/***/ "./resources/js/pages/articles/view.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/pages/articles/view.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./view.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); //# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/Y2E4MyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUEsd0NBQTBMLENBQWdCLGdQQUFHLEVBQUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IG1vZCBmcm9tIFwiLSEuLi8uLi8uLi8uLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/cmVmLS00LTAhLi4vLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi92aWV3LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIjsgZXhwb3J0IGRlZmF1bHQgbW9kOyBleHBvcnQgKiBmcm9tIFwiLSEuLi8uLi8uLi8uLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/cmVmLS00LTAhLi4vLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi92aWV3LnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/pages/articles/view.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&":
/*!*****************************************************************************!*\
  !*** ./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./view.vue?vue&type=template&id=2e668d1e& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_2e668d1e___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/NDdiOSJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGFnZXMvYXJ0aWNsZXMvdmlldy52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9MmU2NjhkMWUmLmpzIiwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0ICogZnJvbSBcIi0hLi4vLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2xvYWRlcnMvdGVtcGxhdGVMb2FkZXIuanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuLi8uLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL3ZpZXcudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTJlNjY4ZDFlJlwiIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/pages/articles/view.vue?vue&type=template&id=2e668d1e&\n");

/***/ })

}]);