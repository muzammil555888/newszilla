require('./bootstrap');

!function(t,o){"object"==typeof exports&&"undefined"!=typeof module?o():"function"==typeof define&&define.amd?define(o):o()}(0,function(){"use strict";if("undefined"==typeof Chart)throw new Error("Shards Dashboard requires the Chart.js library in order to function properly.");window.ShardsDashboards=window.ShardsDashboards?window.ShardsDashboards:{},$.extend($.easing,{easeOutSine:function(t,o,e,i,n){return i*Math.sin(o/n*(Math.PI/2))+e}}),Chart.defaults.LineWithLine=Chart.defaults.line,Chart.controllers.LineWithLine=Chart.controllers.line.extend({draw:function(t){if(Chart.controllers.line.prototype.draw.call(this,t),this.chart.tooltip._active&&this.chart.tooltip._active.length){var o=this.chart.tooltip._active[0],e=this.chart.ctx,i=o.tooltipPosition().x,n=this.chart.scales["y-axis-0"].top,r=this.chart.scales["y-axis-0"].bottom;e.save(),e.beginPath(),e.moveTo(i,n),e.lineTo(i,r),e.lineWidth=.5,e.strokeStyle="#ddd",e.stroke(),e.restore()}}}),$(document).ready(function(){var t={duration:270,easing:"easeOutSine"};$(":not(.main-sidebar--icons-only) .dropdown").on("show.bs.dropdown",function(){$(this).find(".dropdown-menu").first().stop(!0,!0).slideDown(t)}),$(":not(.main-sidebar--icons-only) .dropdown").on("hide.bs.dropdown",function(){$(this).find(".dropdown-menu").first().stop(!0,!0).slideUp(t)}),$(".toggle-sidebar").click(function(t){$(".main-sidebar").toggleClass("open")})})});