﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

		(function() {
			var a = CKEDITOR.document;
			CKEDITOR.dialog.add('templates', function(b) {
				function c(k, l) {
					k.setHtml('');
					for (var m = 0, n = l.length; m < n; m++) {
						var o = CKEDITOR.getTemplates(l[m]), p = o.imagesPath, q = o.templates, r = q.length;
						for (var s = 0; s < r; s++) {
							var t = q[s], u = d(t, p);
							u.setAttribute('aria-posinset', s + 1);
							u.setAttribute('aria-setsize', r);
							k.append(u);
						}
					}
				}
				;
				function d(k, l) {
					var m = CKEDITOR.dom.element.createFromHtml('<a href="javascript:void(0)" tabIndex="-1" role="option" ><div class="cke_tpl_item"></div></a>'), n = '<table style="width:350px;" class="cke_tpl_preview" role="presentation"><tr>';
					if (k.image && l)
						n += '<td class="cke_tpl_preview_img"><img src="' + CKEDITOR.getUrl(l + k.image) + '"' + (CKEDITOR.env.ie6Compat ? ' onload="this.width=this.width"' : '') + ' alt="" title=""></td>';
					n += '<td style="white-space:normal;"><span class="cke_tpl_title">' + k.title + '</span><br/>';
					if (k.description)
						n += '<span>' + k.description + '</span>';
					n += '</td></tr></table>';
					m.getFirst().setHtml(n);
					m.on('click', function() {
						e(k.html);
					});
					return m;
				}
				;
				function e(k) {
					var l = CKEDITOR.dialog.getCurrent(), m = l.getValueOf('selectTpl', 'chkInsertOpt');
					if (m) {
						b.on('contentDom', function(n) {
							n.removeListener();
							l.hide();
							var o = new CKEDITOR.dom.range(b.document);
							o.moveToElementEditStart(b.document.getBody());
							o.select(1);
							setTimeout(function() {
								b.fire('saveSnapshot');
							}, 0);
						});
						b.fire('saveSnapshot');
						b.setData(k);
					} else {
						b.insertHtml(k);
						l.hide();
					}
				}
				;
				function f(k) {
					var l = k.data.getTarget(), m = g.equals(l);
					if (m || g.contains(l)) {
						var n = k.data.getKeystroke(), o = g.getElementsByTag('a'), p;
						if (o) {
							if (m)
								p = o.getItem(0);
							else
								switch (n) {
									case 40:
										p = l.getNext();
										break;
									case 38:
										p = l.getPrevious();
										break;
									case 13:
									case 32:
										l.fire('click');
								}
							if (p) {
								p.focus();
								k.data.preventDefault();
							}
						}
					}
				}
				;
				CKEDITOR.skins.load(b, 'templates');
				var g, h = 'cke_tpl_list_label_' + CKEDITOR.tools.getNextNumber(), i = b.lang.templates, j = b.config;
				return{title: b.lang.templates.title, minWidth: CKEDITOR.env.ie ? 440 : 400, minHeight: 340, contents: [{id: 'selectTpl', label: i.title, elements: [{type: 'vbox', padding: 5, children: [{id: 'selectTplText', type: 'html', html: '<span>' + i.selectPromptMsg + '</span>'}, {id: 'templatesList', type: 'html', focus: true, html: '<div class="cke_tpl_list" tabIndex="-1" role="listbox" aria-labelledby="' + h + '">' + '<div class="cke_tpl_loading"><span></span></div>' + '</div>' + '<span class="cke_voice_label" id="' + h + '">' + i.options + '</span>'}, {id: 'chkInsertOpt', type: 'checkbox', label: i.insertOption, 'default': j.templates_replaceContent}]}]}], buttons: [CKEDITOR.dialog.cancelButton], onShow: function() {
						var k = this.getContentElement('selectTpl', 'templatesList');
						g = k.getElement();
						CKEDITOR.loadTemplates(j.templates_files, function() {
							var l = (j.templates || 'default').split(',');
							if (l.length) {
								c(g, l);
								k.focus();
							} else
								g.setHtml('<div class="cke_tpl_empty"><span>' + i.emptyListMsg + '</span>' + '</div>');
						});
						this._.element.on('keydown', f);
					}, onHide: function() {
						this._.element.removeListener('keydown', f);
					}};
			});
		})();
