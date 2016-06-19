/**
 * Created by 马子航 on 2016/6/19.
 */
angular.module("w5c.validator",["ng"]).provider("w5cValidator",[function(){var a={required:"该选项不能为空",maxlength:"该选项输入值长度不能大于{maxlength}",minlength:"该选项输入值长度不能小于{minlength}",email:"输入邮件的格式不正确",repeat:"两次输入不一致",pattern:"该选项输入格式不正确",number:"必须输入数字",w5cuniquecheck:"该输入值已经存在，请重新输入",url:"输入URL格式不正确",max:"该选项输入值不能大于{max}",min:"该选项输入值不能小于{min}",customizer:"自定义验证不通过"},b=["text","password","email","number","url","tel","hidden",["textarea"],["select"],["select-multiple"],["select-one"],"radio","checkbox"],c=function(a){return"FORM"===a[0].tagName||11==a[0].nodeType?null:a&&a.hasClass("form-group")?a:c(a.parent())},d=function(){this.elemTypes=b,this.rules={},this.isEmpty=function(a){return a?a instanceof Array&&0===a.length?!0:!1:!0},this.defaultShowError=function(a,b){var d=angular.element(a),e=c(d);this.isEmpty(e)||e.hasClass("has-error")||e.addClass("has-error");var f=d.next();f&&f.hasClass("w5c-error")||d.after('<span class="w5c-error">'+b[0]+"</span>")},this.defaultRemoveError=function(a){var b=angular.element(a),d=c(b);!this.isEmpty(d)&&d.hasClass("has-error")&&d.removeClass("has-error");var e=b.next();e.hasClass&&e.hasClass("w5c-error")&&e.remove()},this.options={blurTrig:!1,showError:!0,removeError:!0}};d.prototype={constructor:d,config:function(a){this.options=angular.extend(this.options,a)},setRules:function(a){this.rules=angular.extend(this.rules,a)},getErrorMessage:function(b,c){var d=null,e=c.name;switch(e&&/\$\d+\$/i.test(e)&&(e=e.replace(/\$\d+\$/i,"")),this.isEmpty(this.rules[e])||this.isEmpty(this.rules[e][b])||(d=this.rules[e][b]),b){case"maxlength":return(d||a.maxlength).replace("{maxlength}",c.getAttribute("ng-maxlength"));case"minlength":return(d||a.minlength).replace("{minlength}",c.getAttribute("ng-minlength"));case"max":return(d||a.max).replace("{max}",c.getAttribute("max"));case"min":return(d||a.min).replace("{min}",c.getAttribute("min"));default:if(null!==d)return d;if(null===a[b])throw new Error("该验证规则("+b+")默认错误信息没有设置！");return a[b]}},getErrorMessages:function(a,b){var c=[];for(var d in b)if(b[d]){var e=this.getErrorMessage(d,a);c.push(e)}return c},showError:function(a,b,c){var d=angular.extend({},this.options,c);return angular.element(a).removeClass("valid").addClass("error"),d.showError!==!1?angular.isFunction(d.showError)?d.showError(a,b):d.showError===!0?this.defaultShowError(a,b):void 0:void 0},removeError:function(a,b){var c=angular.extend({},this.options,b);return angular.element(a).removeClass("error").addClass("valid"),c.removeError!==!1?angular.isFunction(c.removeError)?c.removeError(a):c.removeError===!0?this.defaultRemoveError(a):void 0:void 0}};var e=new d;this.config=function(a){e.config(a)},this.setRules=function(a){e.setRules(a)},this.setDefaultRules=function(b){a=angular.extend(a,b)},this.$get=function(){return e}}]),function(){angular.module("w5c.validator").directive("w5cFormValidate",["$parse","w5cValidator","$timeout",function(a,b,c){return{require:["w5cFormValidate","^?form"],controller:["$scope",function(a){this.needBindKeydown=!1,this.form=null,this.formElement=null,this.submitSuccessFn=null,this.validElements=[],this.init=function(a,b){this.form=a,this.formElement=b,this.formName=b.attr("name")},this.doValidate=function(b,c){angular.isFunction(this.form.doValidate)&&this.form.doValidate(),this.form.$valid&&angular.isFunction(b)&&a.$apply(function(){b(a,{$event:c})})},this.removeElementValidation=function(a){var c=this.validElements.indexOf(a);c>=0&&(this.validElements.splice(c,1),b.isEmpty(this.form.$errors)||this.doValidate(angular.noop))},this.removeError=function(a){this.form.$errors=[],this.form[a[0].name]&&(this.form[a[0].name].w5cError=!1),b.removeError(a,this.options)},this.initElement=function(d){var e=angular.element(d),f=this;if(b.elemTypes.toString().indexOf(d.type)>-1&&!b.isEmpty(d.name)&&!/^\d/.test(d.name)){var g=e.attr("disabled");if(g&&("true"===g||"disabled"===g))return;if(!(this.validElements.indexOf(d.name)<0))return;this.validElements.push(d.name);var h=this.formName+"."+d.name+".$viewValue";a.$watch(h,function(){f.removeError(e)},!0),f.options.blurTrig&&e.bind("blur",function(){if(f.options.blurTrig){var a=this,d=angular.element(this);c(function(){if(f.form[a.name].$valid)b.removeError(d,f.options);else{var c=b.getErrorMessages(a,f.form[a.name].$error);b.showError(d,c,f.options),f.form[d[0].name]&&(f.form[d[0].name].w5cError=!0)}},50)}})}}}],link:function(d,e,f,g){var h=g[0],i=g[1],j=e[0],k=a(f.w5cSubmit),l=d.$eval(f.w5cFormValidate);if(!f.name)throw Error("form must has name when use w5cFormValidate");h.init(i,e,f),f.w5cFormValidate&&d.$watch(f.w5cFormValidate,function(a){a&&(h.options=l=angular.extend({},b.options,a))},!0),h.options=l=angular.extend({},b.options,l);for(var m=0;m<j.elements.length;m++){var n=j.elements[m];h.initElement(n)}var o=function(){for(var a=[],c=0;c<j.elements.length;c++){var e=j.elements[c].name;if(e&&h.validElements.indexOf(e)>=0){var f=j[e];if(i[e]&&f&&b.elemTypes.toString().indexOf(f.type)>-1&&!b.isEmpty(f.name)){if(i[e].$valid){angular.element(f).removeClass("error").addClass("valid");continue}var g=b.getErrorMessages(f,i[f.name].$error);a.push(g[0]),b.removeError(f,l),b.showError(f,g,l),i[e].w5cError=!0}}}i.$errors=!b.isEmpty(a)&&a.length>0?a:[],d.$$phase||d.$apply(i.$errors)};i&&(i.doValidate=o,i.reset=function(){c(function(){i.$setPristine();for(var a=0;a<j.elements.length;a++){var c=j.elements[a],d=angular.element(c);b.removeError(d,l)}})}),f.w5cSubmit&&angular.isFunction(k)&&(e.bind("submit",function(a){o(),i.$valid&&angular.isFunction(k)&&d.$apply(function(){k(d,{$event:a})})}),h.needBindKeydown=!0),h.needBindKeydown&&e.bind("keydown keypress",function(a){if(13===a.which){var b=document.activeElement;if(b.type&&"textarea"!==b.type){var c=e.find("button");c&&c[0]&&c[0].focus(),b.focus(),o(),a.preventDefault(),i.$valid&&angular.isFunction(h.submitSuccessFn)&&d.$apply(function(){h.submitSuccessFn(d,{$event:a})})}}})}}}]).directive("w5cFormSubmit",["$parse",function(a){return{require:"^w5cFormValidate",link:function(b,c,d,e){var f=a(d.w5cFormSubmit);c.bind("click",function(a){e.doValidate(f,a)}),e.needBindKeydown=!0,e.submitSuccessFn=f}}}]).directive("w5cRepeat",["$timeout",function(a){"use strict";return{require:["ngModel","^w5cFormValidate"],link:function(b,c,d,e){a(function(){var a=c.inheritedData("$formController")[d.w5cRepeat],b=e[0],f=e[1];b.$parsers.push(function(c){return c===a.$viewValue?b.$setValidity("repeat",!0):b.$setValidity("repeat",!1),c}),a.$parsers.push(function(a){return b.$setValidity("repeat",a===b.$viewValue),a===b.$viewValue&&f.removeError(c),a})})}}}]).directive("w5cCustomizer",["$timeout",function(){"use strict";return{require:["^form","ngModel"],link:function(a,b,c,d){var e=d[1],f=function(){var b=a.$eval(c.w5cCustomizer);b===!0?e.$setValidity("customizer",!0):e.$setValidity("customizer",!1)},g=d[0][c.associate];g&&g.$viewChangeListeners.push(f),e.$viewChangeListeners.push(f)}}}]).directive("w5cUniqueCheck",["$timeout","$http","w5cValidator",function(a,b,c){return{require:["ngModel","?^w5cFormValidate","?^form"],link:function(a,d,e,f){var g=f[0],h=f[1],i=f[2],j=function(){var f=a.$eval(e.w5cUniqueCheck),j=f.url,k=f.isExists;b.get(j).success(function(a){var b=k===!1?"true"==a||1==a:!("true"==a||1==a);if(g.$setValidity("w5cuniquecheck",b),!b){var e=c.getErrorMessage("w5cuniquecheck",d[0]);c.showError(d[0],[e],h.options),i[d[0].name]&&(i[d[0].name].w5cError=!0),i.$errors?i.$errors.unshift(e):i.$errors=[e]}})};g.$viewChangeListeners.push(function(){i.$errors=[],g.$setValidity("w5cuniquecheck",!0),(!g.$invalid||g.$error.w5cuniquecheck)&&g.$dirty&&j()});var k=a.$eval(e.ngModel);if(k){if(g.$invalid&&!g.$error.w5cuniquecheck)return;j()}}}}]).directive("w5cDynamicName",[function(){return{restrict:"A",require:"ngModel",link:function(a,b,c,d){d.$name=a.$eval(c.w5cDynamicName),b.attr("name",a.$eval(c.w5cDynamicName));var e=b.controller("form")||{$addControl:angular.noop};e.$addControl(d)}}}]).directive("w5cDynamicElement",["$timeout",function(a){return{restrict:"A",require:["ngModel","?^w5cFormValidate","?^form"],link:function(b,c,d,e){var f=c[0].name,g=e[2];if(f){c.on("$destroy",function(){e[1].removeElementValidation(f)}),g[f]||g.$addControl(e[0]);var h=!1;e[2].$errors&&e[2].$errors.length>0&&(h=!0),e[1].initElement(c[0]),h&&a(function(){e[1].doValidate(angular.noop)})}}}}])}();