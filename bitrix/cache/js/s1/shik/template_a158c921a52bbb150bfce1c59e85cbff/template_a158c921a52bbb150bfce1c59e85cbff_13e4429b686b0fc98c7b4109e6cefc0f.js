
; /* Start:/bitrix/templates/shik/script.js*/
function eshopOpenNativeMenu()
{
	var native_menu = BX("bx_native_menu");
	var is_menu_active = BX.hasClass(native_menu, "active");

	if (is_menu_active)
	{
		BX.removeClass(native_menu, "active");
		BX.removeClass(BX('bx_menu_bg'), "active");
		BX("bx_eshop_wrap").style.position = "";
		BX("bx_eshop_wrap").style.top = "";
		BX("bx_eshop_wrap").style.overflow = "";
	}
	else
	{
		BX.addClass(native_menu, "active");
		BX.addClass(BX('bx_menu_bg'), "active");
		var topHeight = document.body.scrollTop;
		BX("bx_eshop_wrap").style.position = "fixed";
		BX("bx_eshop_wrap").style.top = -topHeight+"px";
		BX("bx_eshop_wrap").style.overflow = "hidden";
	}

	var easing = new BX.easing({
		duration : 300,
		start : { left : (is_menu_active) ? 0 : -100 },
		finish : { left : (is_menu_active) ? -100 : 0 },
		transition : BX.easing.transitions.quart,
		step : function(state){
			native_menu.style.left = state.left + "%";
		}
	});
	easing.animate();
}

window.addEventListener('resize',
	function() {
		if (window.innerWidth >= 640 && BX.hasClass(BX("bx_native_menu"), "active"))
			eshopOpenNativeMenu();
	},
	false
);

/* End */
;
; /* Start:/bitrix/components/bitrix/sale.basket.basket.line/templates/.default/script.js*/

var sbbl = {

	toggleExpandCollapseCart: function ()
	{
		if (sbbl.bClosed)
		{
			BX.removeClass(sbbl.elemBlock, "close");
			sbbl.elemStatus.innerHTML = sbbl.strCollapse;
			sbbl.bClosed = false;
		}
		else // Opened
		{
			BX.addClass(sbbl.elemBlock, "close");
			sbbl.elemStatus.innerHTML = sbbl.strExpand;
			sbbl.bClosed = true;
		}
		setTimeout(sbbl.toggleMaxHeight, 100);
	},

	fixCartAfterAjax: function ()
	{
		if (sbbl.elemBlock)
		{
			sbbl.elemStatus = BX("bx_cart_block_status");
			if (sbbl.bClosed)
				sbbl.elemStatus.innerHTML = sbbl.strExpand;
			else // Opened
				sbbl.elemStatus.innerHTML = sbbl.strCollapse;

			sbbl.elemProducts = BX('bx_cart_block_products');
		}
	},

	fixCartTopPosition: function()
	{
		var elemPanel = BX("bx-panel");
		if (elemPanel)
		{
			sbbl.elemBlock.style.top = elemPanel.offsetHeight + 5 + 'px';
			setTimeout(sbbl.toggleMaxHeight, 100);
		}
	},

	toggleMaxHeight: function()
	{
		if (! sbbl.elemProducts)
			return;

		if (sbbl.bClosed)
		{
			if (sbbl.bMaxHeight)
			{
				BX.removeClass(sbbl.elemBlock, 'max_height');
				sbbl.bMaxHeight = false;
			}
		}
		else // Opened
		{
			var windowHeight = 'innerHeight' in window
				? window.innerHeight
				: document.documentElement.offsetHeight;

			if (sbbl.bMaxHeight)
			{
				if (sbbl.elemProducts.scrollHeight == sbbl.elemProducts.clientHeight)
				{
					BX.removeClass(sbbl.elemBlock, 'max_height');
					sbbl.bMaxHeight = false;
				}
			}
			else
			{
				if (sbbl.bVerticalTop)
				{
					if (sbbl.elemBlock.offsetTop + sbbl.elemBlock.offsetHeight >= windowHeight)
					{
						BX.addClass(sbbl.elemBlock, 'max_height');
						sbbl.bMaxHeight = true;
					}
				}
				else
				{
					if (sbbl.elemBlock.offsetHeight >= windowHeight)
					{
						BX.addClass(sbbl.elemBlock, 'max_height');
						sbbl.bMaxHeight = true;
					}
				}
			}
		}
	},

	refreshCart: function (data)
	{
		if (! data)
			data = {};

		data.sessid = BX.bitrix_sessid();
		data.siteId = sbbl.siteId;
		data.templateName = sbbl.templateName;
		data.arParams = sbbl.arParams;

		BX.ajax({
			url: sbbl.ajaxPath,
			method: 'POST',
			dataType: 'html',
			data: data,
			onsuccess: function(result)
			{
				if (sbbl.elemBlock)
					sbbl.elemBlock.innerHTML = result;

				setTimeout(sbbl.toggleMaxHeight, 100);
			}
		});
	},

	removeItemFromCart: function (id)
	{
		sbbl.refreshCart ({sbblRemoveItemFromCart: id});
	}
};



/* End */
;
; /* Start:/bitrix/components/bitrix/search.title/script.js*/
function JCTitleSearch(arParams)
{
	var _this = this;

	this.arParams = {
		'AJAX_PAGE': arParams.AJAX_PAGE,
		'CONTAINER_ID': arParams.CONTAINER_ID,
		'INPUT_ID': arParams.INPUT_ID,
		'MIN_QUERY_LEN': parseInt(arParams.MIN_QUERY_LEN)
	};
	if(arParams.WAIT_IMAGE)
		this.arParams.WAIT_IMAGE = arParams.WAIT_IMAGE;
	if(arParams.MIN_QUERY_LEN <= 0)
		arParams.MIN_QUERY_LEN = 1;

	this.cache = [];
	this.cache_key = null;

	this.startText = '';
	this.currentRow = -1;
	this.RESULT = null;
	this.CONTAINER = null;
	this.INPUT = null;
	this.WAIT = null;

	this.ShowResult = function(result)
	{
		var pos = BX.pos(_this.CONTAINER);
		pos.width = pos.right - pos.left;
		_this.RESULT.style.position = 'absolute';
		_this.RESULT.style.top = (pos.bottom + 2) + 'px';
		_this.RESULT.style.left = pos.left + 'px';
		_this.RESULT.style.width = pos.width + 'px';
		if(result != null)
			_this.RESULT.innerHTML = result;

		if(_this.RESULT.innerHTML.length > 0)
			_this.RESULT.style.display = 'block';
		else
			_this.RESULT.style.display = 'none';

		//ajust left column to be an outline
		var th;
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'title-search-result'}, true);
		if(tbl) th = BX.findChild(tbl, {'tag':'th'}, true);
		if(th)
		{
			var tbl_pos = BX.pos(tbl);
			tbl_pos.width = tbl_pos.right - tbl_pos.left;

			var th_pos = BX.pos(th);
			th_pos.width = th_pos.right - th_pos.left;
			th.style.width = th_pos.width + 'px';

			_this.RESULT.style.width = (pos.width + th_pos.width) + 'px';

			//Move table to left by width of the first column
			_this.RESULT.style.left = (pos.left - th_pos.width - 1)+ 'px';

			//Shrink table when it's too wide
			if((tbl_pos.width - th_pos.width) > pos.width)
				_this.RESULT.style.width = (pos.width + th_pos.width -1) + 'px';

			//Check if table is too wide and shrink result div to it's width
			tbl_pos = BX.pos(tbl);
			var res_pos = BX.pos(_this.RESULT);
			if(res_pos.right > tbl_pos.right)
			{
				_this.RESULT.style.width = (tbl_pos.right - tbl_pos.left) + 'px';
			}
		}

		var fade;
		if(tbl) fade = BX.findChild(_this.RESULT, {'class':'title-search-fader'}, true);
		if(fade && th)
		{
			res_pos = BX.pos(_this.RESULT);
			fade.style.left = (res_pos.right - res_pos.left - 18) + 'px';
			fade.style.width = 18 + 'px';
			fade.style.top = 0 + 'px';
			fade.style.height = (res_pos.bottom - res_pos.top) + 'px';
			fade.style.display = 'block';
		}
	}

	this.onKeyPress = function(keyCode)
	{
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'title-search-result'}, true);
		if(!tbl)
			return false;

		var cnt = tbl.rows.length;

		switch (keyCode)
		{
		case 27: // escape key - close search div
			_this.RESULT.style.display = 'none';
			_this.currentRow = -1;
			_this.UnSelectAll();
		return true;

		case 40: // down key - navigate down on search results
			if(_this.RESULT.style.display == 'none')
				_this.RESULT.style.display = 'block';

			var first = -1;
			for(var i = 0; i < cnt; i++)
			{
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					if(first == -1)
						first = i;

					if(_this.currentRow < i)
					{
						_this.currentRow = i;
						break;
					}
					else if(tbl.rows[i].className == 'title-search-selected')
					{
						tbl.rows[i].className = '';
					}
				}
			}

			if(i == cnt && _this.currentRow != i)
				_this.currentRow = first;

			tbl.rows[_this.currentRow].className = 'title-search-selected';
		return true;

		case 38: // up key - navigate up on search results
			if(_this.RESULT.style.display == 'none')
				_this.RESULT.style.display = 'block';

			var last = -1;
			for(var i = cnt-1; i >= 0; i--)
			{
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					if(last == -1)
						last = i;

					if(_this.currentRow > i)
					{
						_this.currentRow = i;
						break;
					}
					else if(tbl.rows[i].className == 'title-search-selected')
					{
						tbl.rows[i].className = '';
					}
				}
			}

			if(i < 0 && _this.currentRow != i)
				_this.currentRow = last;

			tbl.rows[_this.currentRow].className = 'title-search-selected';
		return true;

		case 13: // enter key - choose current search result
			if(_this.RESULT.style.display == 'block')
			{
				for(var i = 0; i < cnt; i++)
				{
					if(_this.currentRow == i)
					{
						if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
						{
							var a = BX.findChild(tbl.rows[i], {'tag':'a'}, true);
							if(a)
							{
								window.location = a.href;
								return true;
							}
						}
					}
				}
			}
		return false;
		}

		return false;
	}

	this.onTimeout = function()
	{
		if(_this.INPUT.value != _this.oldValue && _this.INPUT.value != _this.startText)
		{
			if(_this.INPUT.value.length >= _this.arParams.MIN_QUERY_LEN)
			{
				_this.oldValue = _this.INPUT.value;
				_this.cache_key = _this.arParams.INPUT_ID + '|' + _this.INPUT.value;
				if(_this.cache[_this.cache_key] == null)
				{
					if(_this.WAIT)
					{
						var pos = BX.pos(_this.INPUT);
						var height = (pos.bottom - pos.top)-2;
						_this.WAIT.style.top = (pos.top+1) + 'px';
						_this.WAIT.style.height = height + 'px';
						_this.WAIT.style.width = height + 'px';
						_this.WAIT.style.left = (pos.right - height + 2) + 'px';
						_this.WAIT.style.display = 'block';
					}

					BX.ajax.post(
						_this.arParams.AJAX_PAGE,
						{
							'ajax_call':'y',
							'INPUT_ID':_this.arParams.INPUT_ID,
							'q':_this.INPUT.value,
							'l':_this.arParams.MIN_QUERY_LEN
						},
						function(result)
						{
							_this.cache[_this.cache_key] = result;
							_this.ShowResult(result);
							_this.currentRow = -1;
							_this.EnableMouseEvents();
							if(_this.WAIT)
								_this.WAIT.style.display = 'none';
							setTimeout(_this.onTimeout, 500);
						}
					);
				}
				else
				{
					_this.ShowResult(_this.cache[_this.cache_key]);
					_this.currentRow = -1;
					_this.EnableMouseEvents();
					setTimeout(_this.onTimeout, 500);
				}
			}
			else
			{
				_this.RESULT.style.display = 'none';
				_this.currentRow = -1;
				_this.UnSelectAll();
				setTimeout(_this.onTimeout, 500);
			}
		}
		else
		{
			setTimeout(_this.onTimeout, 500);
		}
	}

	this.UnSelectAll = function()
	{
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'title-search-result'}, true);
		if(tbl)
		{
			var cnt = tbl.rows.length;
			for(var i = 0; i < cnt; i++)
				tbl.rows[i].className = '';
		}
	}

	this.EnableMouseEvents = function()
	{
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'title-search-result'}, true);
		if(tbl)
		{
			var cnt = tbl.rows.length;
			for(var i = 0; i < cnt; i++)
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					tbl.rows[i].id = 'row_' + i;
					tbl.rows[i].onmouseover = function (e) {
						if(_this.currentRow != this.id.substr(4))
						{
							_this.UnSelectAll();
							this.className = 'title-search-selected';
							_this.currentRow = this.id.substr(4);
						}
					};
					tbl.rows[i].onmouseout = function (e) {
						this.className = '';
						_this.currentRow = -1;
					};
				}
		}
	}

	this.onFocusLost = function(hide)
	{
		setTimeout(function(){_this.RESULT.style.display = 'none';}, 250);
	}

	this.onFocusGain = function()
	{
		if(_this.RESULT.innerHTML.length)
			_this.ShowResult();
	}

	this.onKeyDown = function(e)
	{
		if(!e)
			e = window.event;

		if (_this.RESULT.style.display == 'block')
		{
			if(_this.onKeyPress(e.keyCode))
				return BX.PreventDefault(e);
		}
	}

	this.Init = function()
	{
		this.CONTAINER = document.getElementById(this.arParams.CONTAINER_ID);
		this.RESULT = document.body.appendChild(document.createElement("DIV"));
		this.RESULT.className = 'title-search-result';
		this.INPUT = document.getElementById(this.arParams.INPUT_ID);
		this.startText = this.oldValue = this.INPUT.value;
		BX.bind(this.INPUT, 'focus', function() {_this.onFocusGain()});
		BX.bind(this.INPUT, 'blur', function() {_this.onFocusLost()});

		if(BX.browser.IsSafari() || BX.browser.IsIE())
			this.INPUT.onkeydown = this.onKeyDown;
		else
			this.INPUT.onkeypress = this.onKeyDown;

		if(this.arParams.WAIT_IMAGE)
		{
			this.WAIT = document.body.appendChild(document.createElement("DIV"));
			this.WAIT.style.backgroundImage = "url('" + this.arParams.WAIT_IMAGE + "')";
			if(!BX.browser.IsIE())
				this.WAIT.style.backgroundRepeat = 'none';
			this.WAIT.style.display = 'none';
			this.WAIT.style.position = 'absolute';
			this.WAIT.style.zIndex = '1100';
		}

		setTimeout(this.onTimeout, 500);
	}

	BX.ready(function (){_this.Init(arParams)});
}

/* End */
;
; /* Start:/bitrix/templates/shik/components/bitrix/menu/site_top_menu/script.js*/
(function(window) {

	if (!window.BX || BX.CatalogMenu)
		return;

	BX.CatalogMenu = {
		items : {},
		idCnt : 1,
		currentItem : null,
		overItem : null,
		outItem : null,
		timeoutOver : null,
		timeoutOut : null,

		getItem : function(item)
		{
			if (!BX.type.isDomNode(item))
				return null;

			var id = !item.id || !BX.type.isNotEmptyString(item.id) ? (item.id = "menu-item-" + this.idCnt++) : item.id;

			if (!this.items[id])
				this.items[id] = new CatalogMenuItem(item);

			return this.items[id];
		},

		itemOver : function(item)
		{
			var menuItem = this.getItem(item);
			if (!menuItem)
				return;

			if (this.outItem == menuItem)
			{
				clearTimeout(menuItem.timeoutOut);
			}

			this.overItem = menuItem;

			if (menuItem.timeoutOver)
			{
				clearTimeout(menuItem.timeoutOver);
			}

			menuItem.timeoutOver = setTimeout(function() {
				if (BX.CatalogMenu.overItem == menuItem)
				{
					menuItem.itemOver();
				}

			}, 100);
		},

		itemOut : function(item)
		{
			var menuItem = this.getItem(item);
			if (!menuItem)
				return;

			this.outItem = menuItem;

			if (menuItem.timeoutOut)
			{
				clearTimeout(menuItem.timeoutOut);
			}

			menuItem.timeoutOut = setTimeout(function() {

				if (menuItem != BX.CatalogMenu.overItem)
				{
					menuItem.itemOut();
				}
				if (menuItem == BX.CatalogMenu.outItem)
				{
					menuItem.itemOut();
				}

			}, 100);
		}
	};

	var CatalogMenuItem = function(item)
	{
		this.element = item;
		this.popup = BX.findChild(item, { className: "bx_children_container" }, false, false);
		this.isLastItem = BX.lastChild(this.element.parentNode) == this.element;
	};

	CatalogMenuItem.prototype.itemOver = function()
	{
		if (!BX.hasClass(this.element, "hover"))
		{
			BX.addClass(this.element, "hover");
			this.alignPopup();
		}
	};

	CatalogMenuItem.prototype.itemOut = function()
	{
		BX.removeClass(this.element, "hover");
	};

	CatalogMenuItem.prototype.alignPopup = function()
	{
		if (!this.popup)
			return;

		this.popup.style.cssText = "";

		var ulContainer = this.element.parentNode;
		var offsetRightPopup = this.popup.offsetLeft + this.popup.offsetWidth;
		var offsetRightMenu = ulContainer.offsetLeft + ulContainer.offsetWidth;

		if (offsetRightPopup >= offsetRightMenu)
		{
			this.popup.style.right = /*this.isLastItem ? "0px" :*/ "0";
		}
	};
})(window);

function menuCatalogResize(menuID, menuFirstWidth)
{
	var wpasum = 0; // sum of width for all li

	var firstLevelLi = BX.findChildren(BX(menuID), {className : "bx_hma_one_lvl"}, true);

	if (firstLevelLi)
	{
		for(var i = 0; i < firstLevelLi.length; i++)
		{
			var wpa = BX.firstChild(firstLevelLi[i]).clientWidth;
			wpasum += wpa;
		}

		if(menuFirstWidth && (wpasum+20) <= menuFirstWidth)
			BX.addClass(BX(menuID), "small");   //adaptive
		else
			BX.removeClass(BX(menuID), "small");
	}

	return wpasum;
}

function menuCatalogAlign(menuID)
{
	var firstLevelLi = BX.findChildren(BX(menuID), {className : "bx_hma_one_lvl"}, true);
	var wpsum = 0;

	if (firstLevelLi)
	{
		for(var i = 0; i < firstLevelLi.length; i++)
		{
			firstLevelLi[i].removeAttribute("style");
			var wp = firstLevelLi[i].clientWidth;
			wpsum = wpsum+wp;
		}

		var cof_width = wpsum/100;

		for(var i = 0; i < firstLevelLi.length; i++)
		{
			wp = firstLevelLi[i].clientWidth;
			firstLevelLi[i].style.width = (wp/cof_width)+"%";
		}
	}
}

function menuCatalogPadding(menuID)
{
	var firstLevelLi = BX.findChildren(BX(menuID), {className : "bx_hma_one_lvl"}, true);
	var wpsum = 0;

	if (firstLevelLi)
	{
		for(var i = 0; i < firstLevelLi.length; i++)
		{
			BX.firstChild(firstLevelLi[i]).style.padding = "19px 10px";
		}
	}
}

function menuCatalogChangeSectionPicure(element)
{
	var curImgWrapObj = BX.nextSibling(element);
	var curImgObj = BX.clone(BX.firstChild(curImgWrapObj));
	var curDescr = element.getAttribute("data-description");
	var parentObj = BX.hasClass(element, 'bx_hma_one_lvl') ? element : BX.findParent(element, {className:'bx_hma_one_lvl'});
	var sectionImgObj = BX.findChild(parentObj, {className:'bx_section_picture'}, true, false);
	sectionImgObj.innerHTML = "";
	sectionImgObj.appendChild(curImgObj);
	var sectionDescrObj = BX.findChild(parentObj, {className:'bx_section_description'}, true, false);
	sectionDescrObj.innerHTML = curDescr;
	BX.previousSibling(sectionDescrObj).innerHTML = element.innerHTML;
	sectionImgObj.parentNode.href = element.href;
}

function menuCatalogOnresizeHandler()
{
	if (window.catalogMenuIDs)
	{
		for(var obj in window.catalogMenuIDs)
		{
			for(var obj2 in window.catalogMenuIDs[obj])
			{
				menuCatalogResize(obj2, window.catalogMenuIDs[obj][obj2]);
			}
		}
	}
}

if (window.addEventListener)
{
	window.addEventListener('resize', menuCatalogOnresizeHandler, false);
}
else
{
	window.attachEvent("onresize", menuCatalogOnresizeHandler);
}
/* End */
;
; /* Start:/bitrix/components/bitrix/catalog.viewed.products/templates/.default/script.js*/
(function (window) {

if (!!window.JCCatalogSectionViewed)
{
	return;
}

var BasketButton = function(params)
{
	BasketButton.superclass.constructor.apply(this, arguments);
	this.nameNode = BX.create('span', {
		props : { className : 'bx_medium bx_bt_button', id : this.id },
		text: params.text
	});
	this.buttonNode = BX.create('span', {
		attrs: { className: params.ownerClass },
		style: { marginBottom: '0', borderBottom: '0 none transparent' },
		children: [this.nameNode],
		events : this.contextEvents
	});
	if (BX.browser.IsIE())
	{
		this.buttonNode.setAttribute("hideFocus", "hidefocus");
	}
};
BX.extend(BasketButton, BX.PopupWindowButton);

window.JCCatalogSectionViewed = function (arParams)
{
	this.productType = 0;
	this.showQuantity = true;
	this.showAbsent = true;
	this.secondPict = false;
	this.showOldPrice = false;
	this.showPercent = false;
	this.showSkuProps = false;
	this.visual = {
		ID: '',
		PICT_ID: '',
		SECOND_PICT_ID: '',
		QUANTITY_ID: '',
		QUANTITY_UP_ID: '',
		QUANTITY_DOWN_ID: '',
		PRICE_ID: '',
		DSC_PERC: '',
		SECOND_DSC_PERC: '',
		DISPLAY_PROP_DIV: '',
		BASKET_PROP_DIV: ''
	};
	this.product = {
		checkQuantity: false,
		maxQuantity: 0,
		stepQuantity: 1,
		isDblQuantity: false,
		canBuy: true,
		canSubscription: true,
		name: '',
		pict: {},
		id: 0,
		addUrl: '',
		buyUrl: ''
	};
	this.basketData = {
		useProps: false,
		emptyProps: false,
		quantity: 'quantity',
		props: 'prop',
		basketUrl: ''
	};

	this.defaultPict = {
		pict: null,
		secondPict: null
	};

	this.checkQuantity = false;
	this.maxQuantity = 0;
	this.stepQuantity = 1;
	this.isDblQuantity = false;
	this.canBuy = true;
	this.canSubscription = true;
	this.precision = 6;
	this.precisionFactor = Math.pow(10,this.precision);

	this.offers = [];
	this.offerNum = 0;
	this.treeProps = [];
	this.obTreeRows = [];
	this.showCount = [];
	this.showStart = [];
	this.selectedValues = {};

	this.obProduct = null;
	this.obQuantity = null;
	this.obQuantityUp = null;
	this.obQuantityDown = null;
	this.obPict = null;
	this.obSecondPict = null;
	this.obPrice = null;
	this.obTree = null;
	this.obBuyBtn = null;
	this.obDscPerc = null;
	this.obSecondDscPerc = null;
	this.obSkuProps = null;
	this.obMeasure = null;

	this.obPopupWin = null;
	this.basketUrl = '';
	this.basketParams = {};

	this.treeRowShowSize = 5;
	this.treeEnableArrow = { display: '', cursor: 'pointer', opacity: 1 };
	this.treeDisableArrow = { display: '', cursor: 'default', opacity:0.2 };

	this.lastElement = false;
	this.containerHeight = 0;

	this.errorCode = 0;

	if ('object' === typeof arParams)
	{
		this.productType = parseInt(arParams.PRODUCT_TYPE, 10);
		this.showQuantity = arParams.SHOW_QUANTITY;
		this.showAbsent = arParams.SHOW_ABSENT;
		this.secondPict = !!arParams.SECOND_PICT;
		this.showOldPrice = !!arParams.SHOW_OLD_PRICE;
		this.showPercent = !!arParams.SHOW_DISCOUNT_PERCENT;
		this.showSkuProps = !!arParams.SHOW_SKU_PROPS;

		this.visual = arParams.VISUAL;
		switch (this.productType)
		{
			case 1://product
			case 2://set
				if (!!arParams.PRODUCT && 'object' === typeof(arParams.PRODUCT))
				{
					if (this.showQuantity)
					{
						this.product.checkQuantity = arParams.PRODUCT.CHECK_QUANTITY;
						this.product.isDblQuantity = arParams.PRODUCT.QUANTITY_FLOAT;
						if (this.product.checkQuantity)
						{
							this.product.maxQuantity = (this.product.isDblQuantity ? parseFloat(arParams.PRODUCT.MAX_QUANTITY) : parseInt(arParams.PRODUCT.MAX_QUANTITY, 10));
						}
						this.product.stepQuantity = (this.product.isDblQuantity ? parseFloat(arParams.PRODUCT.STEP_QUANTITY) : parseInt(arParams.PRODUCT.STEP_QUANTITY, 10));

						this.checkQuantity = this.product.checkQuantity;
						this.isDblQuantity = this.product.isDblQuantity;
						this.maxQuantity = this.product.maxQuantity;
						this.stepQuantity = this.product.stepQuantity;
						if (this.isDblQuantity)
						{
							this.stepQuantity = Math.round(this.stepQuantity*this.precisionFactor)/this.precisionFactor;
						}
					}
					this.product.canBuy = arParams.PRODUCT.CAN_BUY;
					this.product.canSubscription = arParams.PRODUCT.SUBSCRIPTION;

					this.canBuy = this.product.canBuy;
					this.canSubscription = this.product.canSubscription;

					this.product.name = arParams.PRODUCT.NAME;
					this.product.pict = arParams.PRODUCT.PICT;
					this.product.id = arParams.PRODUCT.ID;
					if (!!arParams.PRODUCT.ADD_URL)
					{
						this.product.addUrl = arParams.PRODUCT.ADD_URL;
					}
					if (!!arParams.PRODUCT.BUY_URL)
					{
						this.product.buyUrl = arParams.PRODUCT.BUY_URL;
					}
					if (!!arParams.BASKET && 'object' === typeof(arParams.BASKET))
					{
						this.basketData.useProps = !!arParams.BASKET.ADD_PROPS;
						this.basketData.emptyProps = !!arParams.BASKET.EMPTY_PROPS;
					}
				}
				else
				{
					this.errorCode = -1;
				}
				break;
			case 3://sku
				if (!!arParams.OFFERS && BX.type.isArray(arParams.OFFERS))
				{
					if (!!arParams.PRODUCT && 'object' === typeof(arParams.PRODUCT))
					{
						this.product.name = arParams.PRODUCT.NAME;
						this.product.id = arParams.PRODUCT.ID;
					}
					this.offers = arParams.OFFERS;
					this.offerNum = 0;
					if (!!arParams.OFFER_SELECTED)
					{
						this.offerNum = parseInt(arParams.OFFER_SELECTED, 10);
					}
					if (isNaN(this.offerNum))
					{
						this.offerNum = 0;
					}
					if (!!arParams.TREE_PROPS)
					{
						this.treeProps = arParams.TREE_PROPS;
					}
					if (!!arParams.DEFAULT_PICTURE)
					{
						this.defaultPict.pict = arParams.DEFAULT_PICTURE.PICTURE;
						this.defaultPict.secondPict = arParams.DEFAULT_PICTURE.PICTURE_SECOND;
					}
				}
				else
				{
					this.errorCode = -1;
				}
				break;
			default:
				this.errorCode = -1;
		}
		if (!!arParams.BASKET && 'object' === typeof(arParams.BASKET))
		{
			if (!!arParams.BASKET.QUANTITY)
			{
				this.basketData.quantity = arParams.BASKET.QUANTITY;
			}
			if (!!arParams.BASKET.PROPS)
			{
				this.basketData.props = arParams.BASKET.PROPS;
			}
			if (!!arParams.BASKET.BASKET_URL)
			{
				this.basketData.basketUrl = arParams.BASKET.BASKET_URL;
			}
		}
		this.lastElement = (!!arParams.LAST_ELEMENT && 'Y' === arParams.LAST_ELEMENT);
	}
	if (0 === this.errorCode)
	{
		BX.ready(BX.delegate(this.Init,this));
	}
};

window.JCCatalogSectionViewed.prototype.Init = function()
{
	var i = 0,
		strPrefix = '',
		TreeItems = null;

	this.obProduct = BX(this.visual.ID);
	if (!this.obProduct)
	{
		this.errorCode = -1;
	}
	this.obPict = BX(this.visual.PICT_ID);
	if (!this.obPict)
	{
		this.errorCode = -2;
	}
	if (this.secondPict && !!this.visual.SECOND_PICT_ID)
	{
		this.obSecondPict = BX(this.visual.SECOND_PICT_ID);
	}
	this.obPrice = BX(this.visual.PRICE_ID);
	if (!this.obPrice)
	{
		this.errorCode = -16;
	}
	if (this.showQuantity && !!this.visual.QUANTITY_ID)
	{
		this.obQuantity = BX(this.visual.QUANTITY_ID);
		if (!!this.visual.QUANTITY_UP_ID)
		{
			this.obQuantityUp = BX(this.visual.QUANTITY_UP_ID);
		}
		if (!!this.visual.QUANTITY_DOWN_ID)
		{
			this.obQuantityDown = BX(this.visual.QUANTITY_DOWN_ID);
		}
	}
	if (3 === this.productType)
	{
		if (!!this.visual.TREE_ID)
		{
			this.obTree = BX(this.visual.TREE_ID);
			if (!this.obTree)
			{
				this.errorCode = -256;
			}
			strPrefix = this.visual.TREE_ITEM_ID;
			for (i = 0; i < this.treeProps.length; i++)
			{
				this.obTreeRows[i] = {
					LEFT: BX(strPrefix+this.treeProps[i].ID+'_left'),
					RIGHT: BX(strPrefix+this.treeProps[i].ID+'_right'),
					LIST: BX(strPrefix+this.treeProps[i].ID+'_list'),
					CONT: BX(strPrefix+this.treeProps[i].ID+'_cont')
				};
				if (!this.obTreeRows[i].LEFT || !this.obTreeRows[i].RIGHT || !this.obTreeRows[i].LIST || !this.obTreeRows[i].CONT)
				{
					this.errorCode = -512;
					break;
				}
			}
		}
		if (!!this.visual.QUANTITY_MEASURE)
		{
			this.obMeasure = BX(this.visual.QUANTITY_MEASURE);
		}
	}
	if (!!this.visual.BUY_ID)
	{
		this.obBuyBtn = BX(this.visual.BUY_ID);
	}

	if (this.showPercent)
	{
		if (!!this.visual.DSC_PERC)
		{
			this.obDscPerc = BX(this.visual.DSC_PERC);
		}
		if (this.secondPict && !!this.visual.SECOND_DSC_PERC)
		{
			this.obSecondDscPerc = BX(this.visual.SECOND_DSC_PERC);
		}
	}

	if (this.showSkuProps)
	{
		if (!!this.visual.DISPLAY_PROP_DIV)
		{
			this.obSkuProps = BX(this.visual.DISPLAY_PROP_DIV);
		}
	}

	if (0 === this.errorCode)
	{
		if (this.showQuantity)
		{
			if (!!this.obQuantityUp)
			{
				BX.bind(this.obQuantityUp, 'click', BX.delegate(this.QuantityUp, this));
			}
			if (!!this.obQuantityDown)
			{
				BX.bind(this.obQuantityDown, 'click', BX.delegate(this.QuantityDown, this));
			}
			if (!!this.obQuantity)
			{
				BX.bind(this.obQuantity, 'change', BX.delegate(this.QuantityChange, this));
			}
		}
		switch (this.productType)
		{
			case 1://product
				break;
			case 3://sku
				TreeItems = BX.findChildren(this.obTree, {tagName: 'li'}, true);
				if (!!TreeItems && 0 < TreeItems.length)
				{
					for (i = 0; i < TreeItems.length; i++)
					{
						BX.bind(TreeItems[i], 'click', BX.delegate(this.SelectOfferProp, this));
					}
				}
				for (i = 0; i < this.obTreeRows.length; i++)
				{
					BX.bind(this.obTreeRows[i].LEFT, 'click', BX.delegate(this.RowLeft, this));
					BX.bind(this.obTreeRows[i].RIGHT, 'click', BX.delegate(this.RowRight, this));
				}
				this.SetCurrent();
				break;
		}
		if (!!this.obBuyBtn)
		{
			BX.bind(this.obBuyBtn, 'click', BX.delegate(this.Basket, this));
		}
		if (this.lastElement)
		{
			this.containerHeight = parseInt(this.obProduct.parentNode.offsetHeight, 10);
			if (isNaN(this.containerHeight))
			{
				this.containerHeight = 0;
			}
			this.setHeight();
			BX.bind(window, 'resize', BX.delegate(this.checkHeight, this));
			BX.bind(this.obProduct.parentNode, 'mouseover', BX.delegate(this.setHeight, this));
			BX.bind(this.obProduct.parentNode, 'mouseout', BX.delegate(this.clearHeight, this));
		}
	}
};

window.JCCatalogSectionViewed.prototype.checkHeight = function()
{
	this.containerHeight = parseInt(this.obProduct.parentNode.offsetHeight, 10);
	if (isNaN(this.containerHeight))
	{
		this.containerHeight = 0;
	}
};

window.JCCatalogSectionViewed.prototype.setHeight = function()
{
	if (0 < this.containerHeight)
	{
		BX.adjust(this.obProduct.parentNode, {style: { height: this.containerHeight+'px'}});
	}
};

window.JCCatalogSectionViewed.prototype.clearHeight = function()
{
	BX.adjust(this.obProduct.parentNode, {style: { height: 'auto'}});
};

window.JCCatalogSectionViewed.prototype.QuantityUp = function()
{
	var curValue = 0,
		boolSet = true;

	if (0 === this.errorCode && this.showQuantity && this.canBuy)
	{
		curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value) : parseInt(this.obQuantity.value, 10));
		if (!isNaN(curValue))
		{
			curValue += this.stepQuantity;
			if (this.checkQuantity)
			{
				if (curValue > this.maxQuantity)
				{
					boolSet = false;
				}
			}
			if (boolSet)
			{
				if (this.isDblQuantity)
				{
					curValue = Math.round(curValue*this.precisionFactor)/this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.QuantityDown = function()
{
	var curValue = 0,
		boolSet = true;

	if (0 === this.errorCode && this.showQuantity && this.canBuy)
	{
		curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value): parseInt(this.obQuantity.value, 10));
		if (!isNaN(curValue))
		{
			curValue -= this.stepQuantity;
			if (curValue < this.stepQuantity)
			{
				boolSet = false;
			}
			if (boolSet)
			{
				if (this.isDblQuantity)
				{
					curValue = Math.round(curValue*this.precisionFactor)/this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.QuantityChange = function()
{
	var curValue = 0,
		boolSet = true;

	if (0 === this.errorCode && this.showQuantity)
	{
		if (this.canBuy)
		{
			curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value) : parseInt(this.obQuantity.value, 10));
			if (!isNaN(curValue))
			{
				if (this.checkQuantity)
				{
					if (curValue > this.maxQuantity)
					{
						boolSet = false;
						curValue = this.maxQuantity;
					}
					else if (curValue < this.stepQuantity)
					{
						boolSet = false;
						curValue = this.stepQuantity;
					}
				}
				if (!boolSet)
				{
					this.obQuantity.value = curValue;
				}
			}
			else
			{
				this.obQuantity.value = this.stepQuantity;
			}
		}
		else
		{
			this.obQuantity.value = this.stepQuantity;
		}
	}
};

window.JCCatalogSectionViewed.prototype.QuantitySet = function(index)
{
	if (0 === this.errorCode)
	{
		this.canBuy = this.offers[index].CAN_BUY;
		if (this.canBuy)
		{
			BX.addClass(this.obBuyBtn, 'bx_bt_button');
			BX.removeClass(this.obBuyBtn, 'bx_bt_button_type_2');
			this.obBuyBtn.innerHTML = BX.message('MESS_BTN_BUY');
		}
		else
		{
			BX.addClass(this.obBuyBtn, 'bx_bt_button_type_2');
			BX.removeClass(this.obBuyBtn, 'bx_bt_button');
			this.obBuyBtn.innerHTML = BX.message('MESS_NOT_AVAILABLE');
		}
		if (this.showQuantity)
		{
			this.isDblQuantity = this.offers[index].QUANTITY_FLOAT;
			this.checkQuantity = this.offers[index].CHECK_QUANTITY;
			if (this.isDblQuantity)
			{
				this.maxQuantity = parseFloat(this.offers[index].MAX_QUANTITY);
				this.stepQuantity = Math.round(parseFloat(this.offers[index].STEP_QUANTITY)*this.precisionFactor)/this.precisionFactor;
			}
			else
			{
				this.maxQuantity = parseInt(this.offers[index].MAX_QUANTITY, 10);
				this.stepQuantity = parseInt(this.offers[index].STEP_QUANTITY, 10);
			}

			this.obQuantity.value = this.stepQuantity;
			this.obQuantity.disabled = !this.canBuy;
			if (!!this.obMeasure)
			{
				if (!!this.offers[index].MEASURE)
				{
					BX.adjust(this.obMeasure, { html : this.offers[index].MEASURE});
				}
				else
				{
					BX.adjust(this.obMeasure, { html : ''});
				}
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.SelectOfferProp = function()
{
	var i = 0,
		value = '',
		strTreeValue = '',
		arTreeItem = [],
		RowItems = null,
		target = BX.proxy_context;

	if (!!target && target.hasAttribute('data-treevalue'))
	{
		strTreeValue = target.getAttribute('data-treevalue');
		arTreeItem = strTreeValue.split('_');
		if (this.SearchOfferPropIndex(arTreeItem[0], arTreeItem[1]))
		{
			RowItems = BX.findChildren(target.parentNode, {tagName: 'li'}, false);
			if (!!RowItems && 0 < RowItems.length)
			{
				for (i = 0; i < RowItems.length; i++)
				{
					value = RowItems[i].getAttribute('data-onevalue');
					if (value === arTreeItem[1])
					{
						BX.addClass(RowItems[i], 'bx_active');
					}
					else
					{
						BX.removeClass(RowItems[i], 'bx_active');
					}
				}
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.SearchOfferPropIndex = function(strPropID, strPropValue)
{
	var strName = '',
		arShowValues = false,
		i, j,
		arCanBuyValues = [],
		index = -1,
		arFilter = {},
		tmpFilter = [];

	for (i = 0; i < this.treeProps.length; i++)
	{
		if (this.treeProps[i].ID === strPropID)
		{
			index = i;
			break;
		}
	}

	if (-1 < index)
	{
		for (i = 0; i < index; i++)
		{
			strName = 'PROP_'+this.treeProps[i].ID;
			arFilter[strName] = this.selectedValues[strName];
		}
		strName = 'PROP_'+this.treeProps[index].ID;
		arShowValues = this.GetRowValues(arFilter, strName);
		if (!arShowValues)
		{
			return false;
		}
		if (!BX.util.in_array(strPropValue, arShowValues))
		{
			return false;
		}
		arFilter[strName] = strPropValue;
		for (i = index+1; i < this.treeProps.length; i++)
		{
			strName = 'PROP_'+this.treeProps[i].ID;
			arShowValues = this.GetRowValues(arFilter, strName);
			if (!arShowValues)
			{
				return false;
			}
			if (this.showAbsent)
			{
				arCanBuyValues = [];
				tmpFilter = [];
				tmpFilter = BX.clone(arFilter, true);
				for (j = 0; j < arShowValues.length; j++)
				{
					tmpFilter[strName] = arShowValues[j];
					if (this.GetCanBuy(tmpFilter))
					{
						arCanBuyValues[arCanBuyValues.length] = arShowValues[j];
					}
				}
			}
			else
			{
				arCanBuyValues = arShowValues;
			}
			if (!!this.selectedValues[strName] && BX.util.in_array(this.selectedValues[strName], arCanBuyValues))
			{
				arFilter[strName] = this.selectedValues[strName];
			}
			else
			{
				arFilter[strName] = arCanBuyValues[0];
			}
			this.UpdateRow(i, arFilter[strName], arShowValues, arCanBuyValues);
		}
		this.selectedValues = arFilter;
		this.ChangeInfo();
	}
	return true;
};

window.JCCatalogSectionViewed.prototype.RowLeft = function()
{
	var i = 0,
		strTreeValue = '',
		index = -1,
		target = BX.proxy_context;

	if (!!target && target.hasAttribute('data-treevalue'))
	{
		strTreeValue = target.getAttribute('data-treevalue');
		for (i = 0; i < this.treeProps.length; i++)
		{
			if (this.treeProps[i].ID === strTreeValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && this.treeRowShowSize < this.showCount[index])
		{
			if (0 > this.showStart[index])
			{
				this.showStart[index]++;
				BX.adjust(this.obTreeRows[index].LIST, { style: { marginLeft: this.showStart[index]*20+'%' }});
				BX.adjust(this.obTreeRows[index].RIGHT, { style: this.treeEnableArrow });
			}

			if (0 <= this.showStart[index])
			{
				BX.adjust(this.obTreeRows[index].LEFT, { style: this.treeDisableArrow });
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.RowRight = function()
{
	var i = 0,
		strTreeValue = '',
		index = -1,
		target = BX.proxy_context;

	if (!!target && target.hasAttribute('data-treevalue'))
	{
		strTreeValue = target.getAttribute('data-treevalue');
		for (i = 0; i < this.treeProps.length; i++)
		{
			if (this.treeProps[i].ID === strTreeValue)
			{
				index = i;
				break;
			}
		}
		if (-1 < index && this.treeRowShowSize < this.showCount[index])
		{
			if ((this.treeRowShowSize - this.showStart[index]) < this.showCount[index])
			{
				this.showStart[index]--;
				BX.adjust(this.obTreeRows[index].LIST, { style: { marginLeft: this.showStart[index]*20+'%' }});
				BX.adjust(this.obTreeRows[index].LEFT, { style: this.treeEnableArrow });
			}

			if ((this.treeRowShowSize - this.showStart[index]) >= this.showCount[index])
			{
				BX.adjust(this.obTreeRows[index].RIGHT, { style: this.treeDisableArrow });
			}
		}
	}
};

window.JCCatalogSectionViewed.prototype.UpdateRow = function(intNumber, activeID, showID, canBuyID)
{
	var i = 0,
		value = '',
		countShow = 0,
		strNewLen = '',
		obData = {},
		pictMode = false,
		extShowMode = false,
		isCurrent = false,
		selectIndex = 0,
		obLeft = this.treeEnableArrow,
		obRight = this.treeEnableArrow,
		currentShowStart = 0,
		RowItems = null;

	if (-1 < intNumber && intNumber < this.obTreeRows.length)
	{
		RowItems = BX.findChildren(this.obTreeRows[intNumber].LIST, {tagName: 'li'}, false);
		if (!!RowItems && 0 < RowItems.length)
		{
			pictMode = ('PICT' === this.treeProps[intNumber].SHOW_MODE);
			countShow = showID.length;
			extShowMode = this.treeRowShowSize < countShow;
			strNewLen = (extShowMode ? (100/countShow)+'%' : '20%');
			obData = {
				props: { className: '' },
				style: {
					width: strNewLen
				}
			};
			if (pictMode)
			{
				obData.style.paddingTop = strNewLen;
			}
			for (i = 0; i < RowItems.length; i++)
			{
				value = RowItems[i].getAttribute('data-onevalue');
				isCurrent = (value === activeID);
				if (BX.util.in_array(value, canBuyID))
				{
					obData.props.className = (isCurrent ? 'bx_active' : '');
				}
				else
				{
					obData.props.className = (isCurrent ? 'bx_active bx_missing' : 'bx_missing');
				}
				obData.style.display = 'none';
				if (BX.util.in_array(value, showID))
				{
					obData.style.display = '';
					if (isCurrent)
					{
						selectIndex = i;
					}
				}
				BX.adjust(RowItems[i], obData);
			}

			obData = {
				style: {
					width: (extShowMode ? 20*countShow : 100)+'%',
					marginLeft: '0%'
				}
			};
			if (pictMode)
			{
				BX.adjust(this.obTreeRows[intNumber].CONT, {props: {className: (extShowMode ? 'bx_item_detail_scu full' : 'bx_item_detail_scu')}});
			}
			else
			{
				BX.adjust(this.obTreeRows[intNumber].CONT, {props: {className: (extShowMode ? 'bx_item_detail_size full' : 'bx_item_detail_size')}});
			}
			if (extShowMode)
			{
				if (selectIndex +1 === countShow)
				{
					obRight = this.treeDisableArrow;
				}
				if (this.treeRowShowSize <= selectIndex)
				{
					currentShowStart = this.treeRowShowSize - selectIndex - 1;
					obData.style.marginLeft = currentShowStart*20+'%';
				}
				if (0 === currentShowStart)
				{
					obLeft = this.treeDisableArrow;
				}
				BX.adjust(this.obTreeRows[intNumber].LEFT, {style: obLeft });
				BX.adjust(this.obTreeRows[intNumber].RIGHT, {style: obRight });
			}
			else
			{
				BX.adjust(this.obTreeRows[intNumber].LEFT, {style: {display: 'none'}});
				BX.adjust(this.obTreeRows[intNumber].RIGHT, {style: {display: 'none'}});
			}
			BX.adjust(this.obTreeRows[intNumber].LIST, obData);
			this.showCount[intNumber] = countShow;
			this.showStart[intNumber] = currentShowStart;
		}
	}
};

window.JCCatalogSectionViewed.prototype.GetRowValues = function(arFilter, index)
{
	var i = 0,
		j,
		arValues = [],
		boolSearch = false,
		boolOneSearch = true;

	if (0 === arFilter.length)
	{
		for (i = 0; i < this.offers.length; i++)
		{
			if (!BX.util.in_array(this.offers[i].TREE[index], arValues))
			{
				arValues[arValues.length] = this.offers[i].TREE[index];
			}
		}
		boolSearch = true;
	}
	else
	{
		for (i = 0; i < this.offers.length; i++)
		{
			boolOneSearch = true;
			for (j in arFilter)
			{
				if (arFilter[j] !== this.offers[i].TREE[j])
				{
					boolOneSearch = false;
					break;
				}
			}
			if (boolOneSearch)
			{
				if (!BX.util.in_array(this.offers[i].TREE[index], arValues))
				{
					arValues[arValues.length] = this.offers[i].TREE[index];
				}
				boolSearch = true;
			}
		}
	}
	return (boolSearch ? arValues : false);
};

window.JCCatalogSectionViewed.prototype.GetCanBuy = function(arFilter)
{
	var i = 0,
		j,
		boolSearch = false,
		boolOneSearch = true;

	for (i = 0; i < this.offers.length; i++)
	{
		boolOneSearch = true;
		for (j in arFilter)
		{
			if (arFilter[j] !== this.offers[i].TREE[j])
			{
				boolOneSearch = false;
				break;
			}
		}
		if (boolOneSearch)
		{
			if (this.offers[i].CAN_BUY)
			{
				boolSearch = true;
				break;
			}
		}
	}
	return boolSearch;
};

window.JCCatalogSectionViewed.prototype.SetCurrent = function()
{
	var i = 0,
		j = 0,
		arCanBuyValues = [],
		strName = '',
		arShowValues = false,
		arFilter = {},
		tmpFilter = [],
		current = this.offers[this.offerNum].TREE;

	for (i = 0; i < this.treeProps.length; i++)
	{
		strName = 'PROP_'+this.treeProps[i].ID;
		arShowValues = this.GetRowValues(arFilter, strName);
		if (!arShowValues)
		{
			break;
		}
		if (BX.util.in_array(current[strName], arShowValues))
		{
			arFilter[strName] = current[strName];
		}
		else
		{
			arFilter[strName] = arShowValues[0];
			this.offerNum = 0;
		}
		if (this.showAbsent)
		{
			arCanBuyValues = [];
			tmpFilter = [];
			tmpFilter = BX.clone(arFilter, true);
			for (j = 0; j < arShowValues.length; j++)
			{
				tmpFilter[strName] = arShowValues[j];
				if (this.GetCanBuy(tmpFilter))
				{
					arCanBuyValues[arCanBuyValues.length] = arShowValues[j];
				}
			}
		}
		else
		{
			arCanBuyValues = arShowValues;
		}
		this.UpdateRow(i, arFilter[strName], arShowValues, arCanBuyValues);
	}
	this.selectedValues = arFilter;
	this.ChangeInfo();
};

window.JCCatalogSectionViewed.prototype.ChangeInfo = function()
{
	var i = 0,
		j,
		index = -1,
		obData = {},
		boolOneSearch = true,
		strPrice = '';

	for (i = 0; i < this.offers.length; i++)
	{
		boolOneSearch = true;
		for (j in this.selectedValues)
		{
			if (this.selectedValues[j] !== this.offers[i].TREE[j])
			{
				boolOneSearch = false;
				break;
			}
		}
		if (boolOneSearch)
		{
			index = i;
			break;
		}
	}
	if (-1 < index)
	{
		if (!!this.obPict)
		{
			if (!!this.offers[index].PREVIEW_PICTURE)
			{
				BX.adjust(this.obPict, {style: {backgroundImage: 'url('+this.offers[index].PREVIEW_PICTURE.SRC+')'}});
			}
			else
			{
				BX.adjust(this.obPict, {style: {backgroundImage: 'url('+this.defaultPict.pict.SRC+')'}});
			}
		}
		if (this.secondPict && !!this.obSecondPict)
		{
			if (!!this.offers[index].PREVIEW_PICTURE_SECOND)
			{
				BX.adjust(this.obSecondPict, {style: {backgroundImage: 'url('+this.offers[index].PREVIEW_PICTURE_SECOND.SRC+')'}});
			}
			else if (!!this.offers[index].PREVIEW_PICTURE.SRC)
			{
				BX.adjust(this.obSecondPict, {style: {backgroundImage: 'url('+this.offers[index].PREVIEW_PICTURE.SRC+')'}});
			}
			else if (!!this.defaultPict.secondPict)
			{
				BX.adjust(this.obSecondPict, {style: {backgroundImage: 'url('+this.defaultPict.secondPict.SRC+')'}});
			}
			else
			{
				BX.adjust(this.obSecondPict, {style: {backgroundImage: 'url('+this.defaultPict.pict.SRC+')'}});
			}
		}
		if (this.showSkuProps && !!this.obSkuProps)
		{
			if (0 === this.offers[index].DISPLAY_PROPERTIES.length)
			{
				BX.adjust(this.obSkuProps, {style: {display: 'none'}, html: ''});
			}
			else
			{
				BX.adjust(this.obSkuProps, {style: {display: ''}, html: this.offers[index].DISPLAY_PROPERTIES});
			}
		}
		if (!!this.obPrice)
		{
			strPrice = this.offers[index].PRICE.PRINT_DISCOUNT_VALUE;
			if (this.showOldPrice && (this.offers[index].PRICE.DISCOUNT_VALUE !== this.offers[index].PRICE.VALUE))
			{
				strPrice += ' <span>'+this.offers[index].PRICE.PRINT_VALUE+'</span>';
			}
			BX.adjust(this.obPrice, {html: strPrice});
			if (this.showPercent)
			{
				if (this.offers[index].PRICE.DISCOUNT_VALUE !== this.offers[index].PRICE.VALUE)
				{
					obData = {
						style: {
							display: ''
						},
						html: this.offers[index].PRICE.DISCOUNT_DIFF_PERCENT
					};
				}
				else
				{
					obData = {
						style: {
							display: 'none'
						},
						html: ''
					};
				}
				if (!!this.obDscPerc)
				{
					BX.adjust(this.obDscPerc, obData);
				}
				if (!!this.obSecondDscPerc)
				{
					BX.adjust(this.obSecondDscPerc, obData);
				}
			}
		}
		this.offerNum = index;
		this.QuantitySet(this.offerNum);
	}
};

window.JCCatalogSectionViewed.prototype.InitBasketUrl = function()
{
	switch (this.productType)
	{
		case 1://product
		case 2://set
			this.basketUrl = this.product.addUrl;
			break;
		case 3://sku
			this.basketUrl = this.offers[this.offerNum].ADD_URL;
			break;
	}
	this.basketParams = {
		'ajax_basket': 'Y'
	};
	if (this.showQuantity)
	{
		this.basketParams[this.basketData.quantity] = this.obQuantity.value;
	}
};

window.JCCatalogSectionViewed.prototype.FillBasketProps = function()
{
	if (!this.visual.BASKET_PROP_DIV)
	{
		return;
	}
	var
		i = 0,
		propCollection = null,
		foundValues = false,
		obBasketProps = null;

	if (this.basketData.useProps && !this.basketData.emptyProps)
	{
		if (!!this.obPopupWin && !!this.obPopupWin.contentContainer)
		{
			obBasketProps = this.obPopupWin.contentContainer;
		}
	}
	else
	{
		obBasketProps = BX(this.visual.BASKET_PROP_DIV);
	}
	if (!obBasketProps)
	{
		return;
	}
	propCollection = obBasketProps.getElementsByTagName('select');
	if (!!propCollection && !!propCollection.length)
	{
		for (i = 0; i < propCollection.length; i++)
		{
			if (!propCollection[i].disabled)
			{
				switch(propCollection[i].type.toLowerCase())
				{
					case 'select-one':
						this.basketParams[propCollection[i].name] = propCollection[i].value;
						foundValues = true;
						break;
					default:
						break;
				}
			}
		}
	}
	propCollection = obBasketProps.getElementsByTagName('input');
	if (!!propCollection && !!propCollection.length)
	{
		for (i = 0; i < propCollection.length; i++)
		{
			if (!propCollection[i].disabled)
			{
				switch(propCollection[i].type.toLowerCase())
				{
					case 'hidden':
						this.basketParams[propCollection[i].name] = propCollection[i].value;
						foundValues = true;
						break;
					case 'radio':
						if (propCollection[i].checked)
						{
							this.basketParams[propCollection[i].name] = propCollection[i].value;
							foundValues = true;
						}
						break;
					default:
						break;
				}
			}
		}
	}
	if (!foundValues)
	{
		this.basketParams[this.basketData.props] = [];
		this.basketParams[this.basketData.props][0] = 0;
	}
};

window.JCCatalogSectionViewed.prototype.SendToBasket = function()
{
	if (!this.canBuy)
	{
		return;
	}
	this.InitBasketUrl();
	this.FillBasketProps();
	BX.ajax.loadJSON(
		this.basketUrl,
		this.basketParams,
		BX.delegate(this.BasketResult, this)
	);
};

window.JCCatalogSectionViewed.prototype.Basket = function()
{
	var contentBasketProps = '';
	if (!this.canBuy)
	{
		return;
	}
	switch (this.productType)
	{
	case 1://product
	case 2://set
		if (this.basketData.useProps && !this.basketData.emptyProps)
		{
			this.InitPopupWindow();
			this.obPopupWin.setTitleBar({
				content: BX.create('div', {
					style: { marginRight: '30px', whiteSpace: 'nowrap' },
					text: BX.message('TITLE_BASKET_PROPS')
				})
			});
			if (BX(this.visual.BASKET_PROP_DIV))
			{
				contentBasketProps = BX(this.visual.BASKET_PROP_DIV).innerHTML;
			}
			this.obPopupWin.setContent(contentBasketProps);
			this.obPopupWin.setButtons([
				new BasketButton({
					ownerClass: this.obProduct.parentNode.parentNode.parentNode.className,
					text: BX.message('BTN_MESSAGE_SEND_PROPS'),
					events: {
						click: BX.delegate(this.SendToBasket, this)
					}
				})
			]);
			this.obPopupWin.show();
		}
		else
		{
			this.SendToBasket();
		}
		break;
	case 3://sku
		this.SendToBasket();
		break;
	}
};

window.JCCatalogSectionViewed.prototype.BasketResult = function(arResult)
{
	var strContent = '',
		strName = '',
		strPict = '',
		successful = true,
		buttons = [];

	if (!!this.obPopupWin)
	{
		this.obPopupWin.close();
	}
	if ('object' !== typeof arResult)
	{
		return false;
	}
	successful = ('OK' === arResult.STATUS);
	if (successful)
	{
		BX.onCustomEvent('OnBasketChange');
		strName = this.product.name;
		switch(this.productType)
		{
		case 1://
		case 2://
			strPict = this.product.pict.SRC;
			break;
		case 3:
			strPict = (!!this.offers[this.offerNum].PREVIEW_PICTURE ?
				this.offers[this.offerNum].PREVIEW_PICTURE.SRC :
				this.defaultPict.pict.SRC
			);
			break;
		}
		strContent = '<div style="width: 96%; margin: 10px 2%; text-align: center;"><img src="'+strPict+'" height="130"><p>'+strName+'</p></div>';
		buttons = [
			new BasketButton({
				ownerClass: this.obProduct.parentNode.parentNode.parentNode.className,
				text: BX.message("BTN_MESSAGE_BASKET_REDIRECT"),
				events: {
					click: BX.delegate(function(){
						location.href = (!!this.basketData.basketUrl ? this.basketData.basketUrl : BX.message('BASKET_URL'));
					}, this)
				}
			})
		];
	}
	else
	{
		strContent = (!!arResult.MESSAGE ? arResult.MESSAGE : BX.message('BASKET_UNKNOWN_ERROR'));
		buttons = [
			new BasketButton({
				ownerClass: this.obProduct.parentNode.parentNode.parentNode.className,
				text: BX.message('BTN_MESSAGE_CLOSE'),
				events: {
					click: BX.delegate(this.obPopupWin.close, this.obPopupWin)
				}
			})
		];
	}
	this.InitPopupWindow();
	this.obPopupWin.setTitleBar({
		content: BX.create('div', {
			style: { marginRight: '30px', whiteSpace: 'nowrap' },
			text: (successful ? BX.message('TITLE_SUCCESSFUL') : BX.message('TITLE_ERROR'))
		})
	});
	this.obPopupWin.setContent(strContent);
	this.obPopupWin.setButtons(buttons);
	this.obPopupWin.show();
};

window.JCCatalogSectionViewed.prototype.InitPopupWindow = function()
{
	if (!!this.obPopupWin)
	{
		return;
	}
	this.obPopupWin = BX.PopupWindowManager.create('CatalogSectionBasket_'+this.visual.ID, null, {
		autoHide: false,
		offsetLeft: 0,
		offsetTop: 0,
		overlay : true,
		closeByEsc: true,
		titleBar: true,
		closeIcon: {top: '10px', right: '10px'}
	});
};
})(window);
/* End */
;
; /* Start:/bitrix/js/fileman/sticker.js*/
function BXSticker(Params, Stickers, MESS)
{
	this.MESS = MESS;
	this.Stickers = Stickers || [];
	this.Params = Params;
	this.sessid_get = Params.sessid_get;
	this.bShowStickers = Params.bShowStickers;
	this.curEditorStickerInd = false;
	this.oneGifSrc = '/bitrix/images/1.gif';
	this.colorSchemes = [
		{name: 'bxst-yellow', color: '#FFFCB3', title: this.MESS.Yellow},
		{name: 'bxst-green', color: '#DBFCCD', title: this.MESS.Green},
		{name: 'bxst-blue', color: '#DCE7F7', title: this.MESS.Blue},
		{name: 'bxst-red', color: '#FCDFDF', title: this.MESS.Red},
		{name: 'bxst-purple', color: '#F6DAF8', title: this.MESS.Purple},
		{name: 'bxst-gray', color: '#F5F5F5', title: this.MESS.Gray}
	];

	this.curPageCount = this.Params.curPageCount;

	// Init hotkeys
	if (this.Params.useHotkeys)
		BX.bind(document, 'keyup', BX.proxy(this.OnKeyUp, this));

	// Object contains result from ajax requests
	window.__bxst_result = {};

	if (Params.bShowStickers)
		this.Init(Params);
}

BXSticker.prototype = {
	Init: function(Params)
	{
		this.oMarkerConfig = {
			attr: {
				title : true,
				src : true,
				href : true,
				alt : true,
				'class' : true,
				className : true,
				id : true,
				name : true,
				type : true,
				value : true
			},
			impAttr: {
				src : true,
				id : true,
				name : true,
				href : true
			}
		};

		this.Params.changeColorEffect = true;
		this.arStickers = [];
		this.posReg = {};
		this.bInited = true;
		this.access = this.Params.access;

		this._arSavedStickers = {};

		BX.bind(document, 'mousedown', BX.proxy(this.OnMousedown, this));
		var _this = this;
		BX.addCustomEvent('onMenuOpen', function(){
			var pEl = BX.findChild(BX('bxst-show-sticker-icon'), {className: 'icon'}, true);
			if (pEl)
			{
				if (_this.bShowStickers)
					BX.addClass(pEl, "checked");
				else
					BX.removeClass(pEl, "checked");
			}
			_this.UpdateStickersCount();
		});

		this.DisplayStickers(!!Params.bVisEffects);

		this.ShowEditor({ind: -1});
	},

	ShowAll: function(bShow, bAddStickers)
	{
		if (typeof bShow == 'undefined')
			bShow = !this.bShowStickers;

		var _this = this;
		var pEl = BX.findChild(BX('bxst-show-sticker-icon'), {className: 'icon'}, true);
		if (pEl)
		{
			if (bShow)
				BX.addClass(pEl, "checked");
			else
				BX.removeClass(pEl, "checked");
		}

		this.bShowStickers = bShow;
		window.__bxst_result.show = null;
		window.__bxst_result.stickers = null;

		this.Request(
			bShow ? 'show_stickers' : 'hide_stickers',
			{
				pageUrl : this.Params.pageUrl,
				b_inited : this.bInited ? "Y" : "N"
			},
			function(res)
			{
				if (_this.bInited)
					return;

				_this.bShowStickers = window.__bxst_result.show;
				if (window.__bxst_result.stickers)
				{
					_this.Stickers = window.__bxst_result.stickers;
					_this.Params.bVisEffects = true;
					if (!_this.bInited)
						_this.Init(_this.Params);

					if (bAddStickers)
						_this.AddSticker();
				}
			}
		);

		if (!bShow)
		{
			this.HideAll();
		}
		else if(bShow && this.bInited)
		{
			var oSt;
			for (var i = 0, l = this.arStickers.length; i < l; i++)
			{
				oSt = this.arStickers[i];
				oSt.pWin.Get().style.display = "block";
				oSt.pShadow.style.display = "block";

				//Hide marker if it exist
				if (oSt.pMarker)
					oSt.pMarker.style.display = "";
			}
		}
	},

	HideAll: function()
	{
		var oSt;
		for (var i = 0, l = this.arStickers.length; i < l; i++)
		{
			oSt = this.arStickers[i];
			oSt.pWin.Get().style.display = "none";
			oSt.pShadow.style.display = "none";

			//Hide marker if it exist
			//if (oSt.pMarkerNode)
			//	BX.removeClass(oSt.pMarkerNode, 'bxst-sicked');
			if (oSt.pMarker)
				oSt.pMarker.style.display = "none";
		}
	},

	AddSticker: function(Sticker, bVisEffects, bShowEditor)
	{
		if (!this.bInited)
			return this.ShowAll(true, true);

		if(!this.bShowStickers && this.bInited)
			this.ShowAll(true, false);

		if (this.curEditorStickerInd !== false) // If we press add sticker hot key in the
		{
			var _this = this;
			this.SaveAndCloseEditor(this.curEditorStickerInd, true, true);
			return setTimeout(function(){_this.AddSticker(Sticker, bVisEffects, bShowEditor);}, 300);
		}

		var oSticker;
		if (Sticker)
		{
			oSticker = this.ConvertStickerObj(Sticker);
		}
		else
		{
			oSticker = {
				bNew: true,
				personal: false,
				colorInd: parseInt(this.Params.start_color),
				width: parseInt(this.Params.start_width),
				height: parseInt(this.Params.start_height),
				collapsed: false,
				completed: false,
				info: "&nbsp;"
			};
		}

		var ind = this.CreateWindow(oSticker, !!bVisEffects, bShowEditor);

		if (oSticker.bNew)
			this.SetMarker(ind, 'area');
	},

	CreateWindow: function(oSticker, bVisEffects, bShowEditor)
	{
		// Init common window object with basic functionality
		var pWin = new BX.CWindow(false, 'float');
		pWin.Show(true); // Show window
		pWin.Get().style.zIndex = pWin.zIndex = this.Params.zIndex;

		// Set resize limits
		pWin.SETTINGS.min_width = this.Params.min_width;
		pWin.SETTINGS.min_height = this.Params.min_height;
		BX.addClass(pWin.Get(), 'bx-sticker');
		pWin.DenyClose();

		var
			bReadonly = this.access == 'R',
			bNew = !!oSticker.bNew,
			_this = this,
			pTypeCont,
			ind = this.arStickers.length,// Index of element in arStickers array
			pHead = pWin.Get().appendChild(BX.create("DIV", {props: {className: 'bxst-header', id: 'bxst_head_' + ind}})),
			pIdsCont = pHead.appendChild(BX.create("DIV", {props: {className: 'bxst-id-cont bxst-title'}, html: oSticker.id > 0 ? '<a href="' + this.Params.pageUrl + "?show_sticker=" + oSticker.id + '"><span>' + oSticker.id + '</span></a>' : ''})),
			pCheckCont = pHead.appendChild(BX.create("DIV", {props: {className: 'bxst-check-cont'}})),
			pCheck = pCheckCont.appendChild(BX.create("INPUT", {props: {id: 'bxst_conplited_' + ind, name: 'bxst_conplited_' + ind, type: "checkbox", value: "Y", title: this.MESS.Complete}})),
			pCheckLabel = pCheckCont.appendChild(BX.create("LABEL", {attrs: {'for' : 'bxst_conplited_' + ind, title: this.MESS.Complete}, text: this.MESS.CompleteLabel})),
			pCollapsedTitle = pHead.appendChild(BX.create("DIV", {props: {id: 'bxst_col_title_' + ind, className: 'bxst-col-title-cont', title: this.MESS.UnCollapseTitle}})),
			pCloseBut = pHead.appendChild(BX.create("DIV", {props: {className: 'bxst-close bxst-but', title: this.MESS.Close}})).appendChild(BX.create("IMG", {props: {id: 'bxst_close_' + ind, src: this.oneGifSrc, className: 'bxst-sprite'}})),
			pCollapseBut = pHead.appendChild(BX.create("DIV", {props: {className: 'bxst-collapse bxst-but'}})).appendChild(BX.create("IMG", {props: {id: 'bxst_collapse_' + ind, src: this.oneGifSrc, className: 'bxst-sprite', title: this.MESS.Collapse}}));

		if (bNew || this.Params.curUserId == oSticker.authorId)
		{
			pTypeCont = pHead.appendChild(BX.create("DIV", {props: {id: 'bxst_type_' + ind, className: 'bxst-type-cont'}}));
			// Create type selector personal-public
			pTypeCont.appendChild(BX.create("DIV", {props: {className: 'bxst-type-l bxst-type-corn'}}));
			pTypeCont.appendChild(BX.create("DIV", {props: {className: 'bxst-type-c bxst-type-c-publ'}})).appendChild(BX.create("SPAN", {props: {}, text: this.MESS.Public}));
			pTypeCont.appendChild(BX.create("DIV", {props: {className: 'bxst-type-c  bxst-type-c-pers'}})).appendChild(BX.create("SPAN", {props: {}, text: this.MESS.Personal}));
			pTypeCont.appendChild(BX.create("DIV", {props: {className: 'bxst-type-r bxst-type-corn'}}));

			if (!bReadonly)
				pTypeCont.onclick = function(){if(!pWin.__stWasDragged){_this.SetType(parseInt(this.id.substr('bxst_type_'.length)), true);}};

			this.SetUnselectable([pTypeCont]);
		}

		var pBody = pWin.Get().appendChild(BX.create("DIV", {props: {id: 'bxst_body_' + ind, className: 'bxst-content'}}));
		var pContentArea = pBody.appendChild(BX.create("DIV", {props: {id: 'bxst_content_' + ind, className: 'bxst-content-area'}}));

		var
			pFoot = pWin.Get().appendChild(BX.create("DIV", {props: {className: 'bxst-footer'}})),
			pMarkerAreaBut = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-marker-area-but'}})).appendChild(BX.create("IMG", {props: {id: 'bxst_marker_but0_' + ind, src: this.oneGifSrc, className: 'bxst-sprite', title: this.MESS.SetMarkerArea}})),
			pMarkerElementBut = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-marker-elem-but'}})).appendChild(BX.create("IMG", {props: {id: 'bxst_marker_but1_' + ind, src: this.oneGifSrc, className: 'bxst-sprite', title: this.MESS.SetMarkerEl}})),
			pColorBut = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-ctrl-txt bxst-color-but'}})).appendChild(BX.create("SPAN", {props: {id: 'bxst_color_' + ind}, text: this.MESS.Color})),
			pAddBut = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-ctrl-txt bxst-add-but'}})).appendChild(BX.create("SPAN", {props: {id: 'bxst_add_but_' + ind}, text: this.MESS.Add})),

			pResizer = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-resizer'}})).appendChild(BX.create("IMG", {props: {src: this.oneGifSrc, className: 'bxst-sprite'}}));

		var pInfo = pFoot.appendChild(BX.create("DIV", {props: {className: 'bxst-info-icon'}})).appendChild(BX.create("IMG", {props: {id: 'bxst_info_' + ind, src: this.oneGifSrc, className: 'bxst-sprite'}, style: {display: bNew ? 'none' : 'block'}}));
		var pHint = new BX.CHintSimple({parent: pInfo, hint: oSticker.info});

		if (bReadonly)
			BX.addClass(pWin.Get(), 'bx-sticker-readonly');

		// Adjust position to the center of the window.
		var windowSize = BX.GetWindowInnerSize();
		var windowScroll = BX.GetWindowScrollPos();

		if (bNew || oSticker.left <= 0 || oSticker.top <= 0)
		{
			oSticker.left = pWin.Get().style.left = parseInt(windowScroll.scrollLeft + windowSize.innerWidth / 2 - parseInt(pWin.Get().offsetWidth) / 2) + Math.round(oSticker.width / 2);
			oSticker.top = Math.max(parseInt(windowScroll.scrollTop + windowSize.innerHeight / 2 - parseInt(pWin.Get().offsetHeight) / 2), 0) - Math.round(oSticker.height / 2);
		}

		pWin.StickerInd = ind;

		if (bNew)
			pAddBut.style.display = 'none';

		// Create shadow
		pShadow = document.body.appendChild(BX.create("DIV", {props: {className: 'bxst-shadow'}, style: {zIndex: parseInt(pWin.Get().style.zIndex) - 5}}));

		this.RegisterSticker({
			obj: oSticker,
			pWin: pWin,
			pCheck: pCheck,
			pCloseBut: pCloseBut,
			pCollapseBut: pCollapseBut,
			pCollapsedTitle: pCollapsedTitle,
			pBody: pBody,
			pHead: pHead,
			pTypeCont: pTypeCont || false,
			pContentArea: pContentArea,
			pIdsCont: pIdsCont,
			pShadow: pShadow,
			bButPanelShowed: true,
			pMarkerAreaBut: pMarkerAreaBut,
			pMarkerElementBut: pMarkerElementBut,
			pColorBut: pColorBut,
			pAddBut: pAddBut,
			pInfo: pInfo,
			pHint: pHint,
			_over: !bNew && !bShowEditor,
			bButPanelShowed: !bNew && !bShowEditor
		});

		this.AdjustToSize(ind, oSticker.width, oSticker.height);
		this.SetColorScheme(ind, oSticker.colorInd, false);
		this.SetType(ind, false, oSticker.personal ? 'personal' : 'public');
		this.SetCompleted(ind, oSticker.completed, false);
		this.CollapseSticker(ind, false, oSticker.collapsed);

		pWin.SetDraggable(pHead);
		BX.addCustomEvent(pWin, 'onWindowDragStart', function(){this.__stWasDragged = true;});
		BX.addCustomEvent(pWin, 'onWindowDragFinished', function(){_this.OnDragEnd(this);});
		BX.addCustomEvent(pWin, 'onWindowDrag', function(){_this.OnDragDrop(this);});

		// Set and config resizer
		pWin.SetResize(pResizer);
		BX.addCustomEvent(pWin, 'onWindowResize', function(){_this.AdjustToSize(this.StickerInd);});
		BX.addCustomEvent(pWin, 'onWindowResizeStart', function(){_this.OnResizeStart(this);});
		BX.addCustomEvent(pWin, 'onWindowResizeFinished', function(){_this.OnResizeEnd(this);});

		// Control events
		pHead.ondblclick = function(){_this.CollapseSticker(parseInt(this.id.substr('bxst_head_'.length)), true);}
		pCollapseBut.onclick = function(){if(!pWin.__stWasDragged){_this.CollapseSticker(parseInt(this.id.substr('bxst_collapse_'.length)), true);}};

		if (!bReadonly)
		{
			// Control events
			pCloseBut.onclick = function(){if(!pWin.__stWasDragged){_this.CloseSticker(parseInt(this.id.substr('bxst_close_'.length)), true);}};
			//pTypeCont.onclick = function(){if(!pWin.__stWasDragged){_this.SetType(parseInt(this.id.substr('bxst_type_'.length)), true);}};
			pAddBut.onclick = function(){_this.AddToSticker(parseInt(this.id.substr('bxst_add_but_'.length)));};
			pCheck.onclick = function(){if(!pWin.__stWasDragged){_this.SetCompleted(parseInt(this.id.substr('bxst_conplited_'.length)), !!this.checked, true);}};
			pColorBut.onclick = function(){_this.ShowColorSelector(parseInt(this.id.substr('bxst_color_'.length)));};

			pMarkerAreaBut.onclick = function(){_this.SetMarker(parseInt(this.id.substr('bxst_marker_but0_'.length)), 'area');};
			pMarkerElementBut.onclick = function(){_this.SetMarker(parseInt(this.id.substr('bxst_marker_but1_'.length)),  'element');};
		}
		else
		{
			pCheck.disabled = true;
		}

		// Hide Buttons Panel instead of calling ShowButtonsPanel method
		if (!bNew && !bShowEditor && !oSticker.collapsed)
			pWin.Get().style.height = (oSticker.height - 24) + "px";

		if (bNew)
		{
			var pos = this.GetSuitablePosition(oSticker.left, oSticker.top);
			if (pos !== true)
			{
				oSticker.left = pos.left;
				oSticker.top = pos.top;
			}
		}
		else
		{
			pIdsCont.style.display = "block";
		}
		this.RegisterPosition(oSticker.left, oSticker.top);

		// Set start position
		pWin.Get().style.left = oSticker.left + 'px';
		pWin.Get().style.top = oSticker.top + 'px';

		this.SupaFlySticker(ind);
		this.AdjustShadow(ind);

		// Set unselectable elements
		this.SetUnselectable([pCloseBut, pCollapseBut, pColorBut, pMarkerAreaBut, pMarkerAreaBut, pResizer]);

		if (bNew || bShowEditor === true)
		{
			this.ShowEditor({ind: ind});

			if (bShowEditor)
			{
				this.OnDivMouseOver(ind, true);
				this.DisplayMarker(ind);
			}
		}
		else
		{
			pBody.style.overflow = 'auto';
			pContentArea.innerHTML = oSticker.html_content;
			//this.ShowButtonsPanel(ind, false, false);
			this.DisplayMarker(ind);

			if (oSticker.id == this.Params.focusOnSticker)
			{
				window.scrollTo(0, oSticker.top > 200 ? oSticker.top - 200 : 0);
				this.Hightlight(ind, true);
				this.BlinkRed(ind);
			}
		}


		if (!bReadonly)
		{
			pBody.onclick = function()
			{
				if (!this.id)
					return;
				var ind = parseInt(this.id.substr('bxst_body_'.length));
				if (_this.curEditorStickerInd !== ind)
					_this.ShowEditor({ind: ind});
			};
		}

		// Hide and show buttons panel
		pWin.Get().onmouseover = function(){_this.OnDivMouseOver(ind, true);};
		pWin.Get().onmouseout = function(){_this.OnDivMouseOver(ind, false);};

		return ind;
	},

	UpdateNewSticker: function(ind)
	{
		var oSt = this.arStickers[ind];
		oSt.pAddBut.style.display = 'block';
		oSt.pInfo.style.display = 'block';
		oSt.pIdsCont.style.display = "block";
		oSt.pIdsCont.innerHTML = '<a href="' + this.Params.pageUrl + "?show_sticker=" + oSt.obj.id + '"><span>' + oSt.obj.id + '</span></a>';

		if (ind === this.curEditorStickerInd && typeof window.oLHESticker == 'object')
		{
			setTimeout(function(){oLHESticker.SetFocusToEnd();}, 100);
			setTimeout(function(){oLHESticker.SetFocusToEnd();}, 500);
		}
	},

	RegisterPosition: function(l, t)
	{
		var
			d = 20,
			l1 = Math.round(l / d) * d,
			t1 = Math.round(t / d) * d;

		this.posReg[l1 + "_" + t1] = true;
	},

	GetSuitablePosition: function(l, t, bAdjust)
	{
		var
			d = 20,
			l1 = Math.round(l / d) * d,
			t1 = Math.round(t / d) * d;

		if (this.posReg[l1 + "_" + t1])
			return this.GetSuitablePosition(l + d, t + d, true);
		else if (bAdjust)
			return {left: l, top: t};

		return true;
	},

	RegisterSticker: function(oSt)
	{
		this.arStickers.push(oSt);
		return this.arStickers.length - 1;
	},

	AdjustToSize: function(ind, w, h)
	{
		var contHeight, oSt = this.arStickers[ind];
		if (typeof w == 'undefined' || typeof h == 'undefined')
		{
			w = parseInt(oSt.pWin.Get().style.width);
			h = parseInt(oSt.pWin.Get().style.height);
		}
		else
		{
			oSt.pWin.Get().style.width = w + "px";
			oSt.pWin.Get().style.height = h + "px";
		}

		if (BX.browser.IsIE() && !BX.browser.IsDoctype())
			contHeight = h - 19 /* header section */ - 27 /* footer section */ - 0;
		else
			contHeight = h - 19 /* header section */ - 24 /* footer section */ - 0;

		if (window.oLHESticker)
		{
			window.oLHESticker.pFrame.style.width = (w - 2)+ "px";
			window.oLHESticker.pFrame.style.height = (contHeight - 2) + "px";
			window.oLHESticker.ResizeFrame(contHeight - 2);
		}

		oSt.pCollapsedTitle.style.width = (w - 100) + "px";
		oSt.pBody.style.height = contHeight + "px";

		this.AdjustShadow(ind);
	},

	AdjustShadow: function(ind)
	{
		var oSt = this.arStickers[ind];

		if (oSt.obj.closed && oSt.pShadow.parentNode)
			return oSt.pShadow.parentNode.removeChild(oSt.pShadow);

		oSt.pShadow.style.top = (parseInt(oSt.pWin.Get().style.top) + 4) + "px";
		oSt.pShadow.style.left = (parseInt(oSt.pWin.Get().style.left) + 3) + "px";
		oSt.pShadow.style.width = oSt.pWin.Get().style.width;
		oSt.pShadow.style.height = oSt.pWin.Get().style.height;
	},

	AdjustEditorSizeAndPos: function(ind)
	{
		var oSt = this.arStickers[ind];
		this.pEditorCont.style.top = (parseInt(oSt.pWin.Get().style.top) + 20) + "px";
		this.pEditorCont.style.left = oSt.pWin.Get().style.left;
		this.pEditorCont.style.width = oSt.pWin.Get().style.width;
		this.pEditorCont.style.height = oSt.pBody.style.height;
		this.pEditorCont.style.zIndex = parseInt(oSt.pWin.Get().style.zIndex) + 10;
	},

	AdjustHintToCursor: function(pHint, e)
	{
		pHint.style.left = (e.realX + 30) + "px";
		pHint.style.top = (e.realY - 12) + "px";
	},

	AdjustScrollPosToCursor: function()
	{
	},

	AdjustStickerToArea: function(ind)
	{
		var
			x, y,
			size = BX.GetWindowInnerSize(document),
			scroll = BX.GetWindowScrollPos(document),
			oSt = this.arStickers[ind],
			deltaH = (oSt.obj.marker && oSt.obj.marker.adjust) ? 0 : 10;

		if (oSt.pMarker && oSt.obj.marker)
		{
			x = oSt.obj.marker.left + oSt.obj.marker.width - 60;
			y = oSt.obj.marker.top - oSt.obj.height + deltaH;

			if (x + oSt.obj.width > size.innerWidth)
				x = size.innerWidth - oSt.obj.width - 30;

			if (y < scroll.scrollTop + 50)
				y = oSt.obj.marker.top + oSt.obj.marker.height - deltaH;
		}

		this.MoveToPos(ind, {left: x, top: y});
		oSt.obj.top = y;
		oSt.obj.left = x;

		if (this.arStickers[ind].obj.id)
			this.SaveSticker(ind);
	},

	MoveToPos: function(ind, resPos)
	{
		var oSt = this.arStickers[ind];
		var
			startTop = parseInt(oSt.obj.top),
			startLeft = parseInt(oSt.obj.left),
			endTop = parseInt(resPos.top),
			endLeft = parseInt(resPos.left),
			curTop = parseInt(startTop),
			curLeft = parseInt(startLeft),

			_this = this,
			count = 0,
			bUp = startTop > endTop,
			bLeft = startLeft > endLeft,
			time = BX.browser.IsIE() ? 10 : 10,
			d = BX.browser.IsIE() ? 10 : 10,
			d1 = Math.ceil(Math.abs((startLeft - endLeft) / 50)),
			d2 = Math.ceil(Math.abs((startTop - endTop) / 50)),
			dx = bLeft ? -d1 : d1,
			dy = bUp ? -d2 : d2;

		var SetPos = function(t, l)
		{
			if (t !== false)
				oSt.pWin.Get().style.top = t + "px";
			if (l !== false)
				oSt.pWin.Get().style.left = l + "px";
			_this.AdjustShadow(ind);
		};

		var Interval = setInterval(function()
			{
				if (endTop != curTop && curTop !== false)
					curTop += Math.round(dy * count / 2);
				if (endLeft != curLeft && curLeft !== false)
					curLeft += Math.round(dx * count / 2);

				if (curTop !== false && (!bUp && curTop >= endTop || bUp && curTop <= endTop))
					curTop = endTop;

				if (curLeft !== false && (!bLeft && curLeft >= endLeft || bLeft && curLeft <= endLeft))
					curLeft = endLeft;

				SetPos(curTop, curLeft);

				if (curTop == endTop)
					curTop = false;

				if (curLeft == endLeft)
					curLeft = false;

				if (curTop === false && curLeft === false)
				{
					clearInterval(Interval);
					return _this.OnDragEnd(oSt.pWin);
				}
				count++;
			},
			time
		);
	},

	ChangeColor: function(ind, colorInd, bEffect, bFadeIn)
	{
		var oSt = this.arStickers[ind];
		if (!this.Params.changeColorEffect)
			bEffect = false;

		if (bEffect && bFadeIn === true)
		{
			this.Params.start_color = colorInd;
			return this.ShowColorOverlay(ind, colorInd, true);
		}
		else if((bEffect && bFadeIn === false) || !bEffect)
		{
			this.SetColorScheme(ind, colorInd, true);
			if (bEffect)
				return this.ShowColorOverlay(ind, colorInd, false);
		}
	},

	SetColorScheme: function(ind, colorInd, bSave)
	{
		// If we have editor
		if (ind === this.curEditorStickerInd && typeof window.oLHESticker == 'object')
		{
			if (window.oLHESticker.pEditorDocument && window.oLHESticker.pEditorDocument.body)
				window.oLHESticker.pEditorDocument.body.className = this.colorSchemes[colorInd].name;
		}

		this.arStickers[ind].obj.colorInd = colorInd;
		for (var i = 0, l = this.colorSchemes.length; i < l; i++)
		{
			if (i == colorInd)
				BX.addClass(this.arStickers[ind].pWin.Get(), this.colorSchemes[i].name);
			else
				BX.removeClass(this.arStickers[ind].pWin.Get(), this.colorSchemes[i].name);
		}

		if (this.arStickers[ind].pMarker)
			this.arStickers[ind].pMarker.className = 'bxst-sticker-marker ' + this.colorSchemes[colorInd].name;

		if (bSave && this.arStickers[ind].obj.id > 0)
		{
			var _this = this;
			if (this.arStickers[ind]._colTimeout)
			{
				clearTimeout(this.arStickers[ind]._colTimeout);
				this.arStickers[ind]._colTimeout = null;
			}

			// Save color with some delay for fast clicking colot controll
			// this.arStickers[ind]._colTimeout = setTimeout(function()
			// {
				//_this.arStickers[ind]._colTimeout = null;
				_this.SaveSticker(ind);
			//}, 800);
		}
	},

	SetType: function(ind, bSave, type)
	{
		var
			oSt = this.arStickers[ind],
			bPersonal = (typeof type == 'undefined') ? !oSt.obj.personal : type == 'personal';

		if (!oSt.pTypeCont)
			return;

		if (bPersonal)
		{
			BX.addClass(oSt.pTypeCont, 'bxst-type-pers');
			BX.removeClass(oSt.pTypeCont, 'bxst-type-publ');
			oSt.pTypeCont.title = this.MESS.PersonalTitle;
		}
		else
		{
			BX.addClass(oSt.pTypeCont, 'bxst-type-publ');
			BX.removeClass(oSt.pTypeCont, 'bxst-type-pers');
			oSt.pTypeCont.title = this.MESS.PublicTitle;
		}
		oSt.obj.personal = bPersonal;

		if (oSt.obj.id && bSave) // Sticker already created - we change type and save it
			this.SaveSticker(ind);
	},

	SetCompleted: function(ind, bChecked, bSave)
	{
		this.arStickers[ind].obj.completed = bChecked;
		this.arStickers[ind].pCheck.checked = bChecked;

		if (bChecked)
		{
			//BX.addClass(this.arStickers[ind].pWin.Get(), "bxst-completed");
			//this.arStickers[ind].pShadow.style.display = 'none';
		}
		else
		{
			//BX.removeClass(this.arStickers[ind].pWin.Get(), "bxst-completed");
			//this.arStickers[ind].pShadow.style.display = 'block';
		}

		if (this.arStickers[ind].obj.id && bSave)
			this.SaveSticker(ind);
	},

	CloseSticker: function(ind, bSave, bClose)
	{
		var oSt = this.arStickers[ind];
		if (bSave && oSt.obj.authorName && this.Params.curUserId != oSt.obj.authorId && !confirm(this.MESS.CloseConfirm.replace("#USER_NAME#", oSt.obj.authorName)))
			return;

		oSt.obj.closed = !oSt.obj.closed;

		if (ind === this.curEditorStickerInd)
			this.curEditorStickerInd = false;

		this.arStickers[ind].pWin.Close(true);
		this.arStickers[ind].pWin.onUnRegister(true);

		//Hide marker if it exist
		if (oSt.pMarkerNode)
			BX.removeClass(oSt.pMarkerNode, 'bxst-sicked');
		if (oSt.pMarker && oSt.pMarker.parentNode)
			oSt.pMarker.parentNode.removeChild(oSt.pMarker);

		this.AdjustShadow(ind);

		if (this.arStickers[ind].obj.id && bSave)
		{
			this.SaveSticker(ind);
			BX.admin.panel.Notify(this.MESS.CloseNotify.replace(/(.*?)#LINK#(.*?)#LINK#/ig, "$1<span class=\"bxst-close-notify-link\" onclick=\"window.oBXSticker.ShowList(\'current\'); return false;\">$2</span>"));
		}

		var a = document.body.getElementsByTagName('A');
		if (a && a[0])
			BX.focus(a[0]);
	},

	CollapseSticker: function(ind, bSave, bCollapse)
	{
		var oSt = this.arStickers[ind];

		if (typeof bCollapse == 'undefined')
			bCollapse = !oSt.obj.collapsed;

		if (bSave && this.curEditorStickerInd === ind)
			this.SaveAndCloseEditor(ind, true, false);

		if (bCollapse)
		{
			BX.addClass(oSt.pWin.Get(), "bxst-collapsed");
			oSt.pCollapseBut.title = this.MESS.UnCollapse;
			oSt.pWin.Get().style.height = '19px';
			oSt.pCollapsedTitle.innerHTML = this.GetCollapsedContent(oSt.obj.html_content);
		}
		else
		{
			BX.removeClass(oSt.pWin.Get(), "bxst-collapsed");
			oSt.pCollapseBut.title = this.MESS.Collapse;
			oSt.pWin.Get().style.height = parseInt(oSt.obj.height) + 'px';
		}

		this.AdjustShadow(ind);

		oSt.obj.collapsed = bCollapse;

		if (oSt.obj.id && bSave)
			this.SaveSticker(ind);
	},

	OnDragEnd: function(pWin)
	{
		setTimeout(function(){pWin.__stWasDragged = false;}, 200);
		var ind = pWin.StickerInd;

		this.arStickers[ind].obj.top = parseInt(pWin.Get().style.top);
		this.arStickers[ind].obj.left = parseInt(pWin.Get().style.left);

		this.SaveSticker(ind);
	},

	OnDragDrop: function(pWin)
	{
		this.AdjustShadow(pWin.StickerInd);
	},

	OnResizeEnd: function(pWin)
	{
		var ind = pWin.StickerInd;
		this.arStickers[ind].bResizingNow = false;
		this.arStickers[ind].obj.width = parseInt(pWin.Get().style.width);
		this.arStickers[ind].obj.height = parseInt(pWin.Get().style.height);

		if (this.arStickers[ind].obj.id)
			this.SaveSticker(ind);
	},

	OnResizeStart: function(pWin)
	{
		this.arStickers[pWin.StickerInd].bResizingNow = true;
	},

	ShowEditor: function(Params)
	{
		var
			bPreload = Params.ind === -1,
			_this = this,
			oSt = this.arStickers[Params.ind];

		// Create if it's necessary and move to the current sticker window
		// (We have one editor and simply append it to different sticker windows)
		if (!this.pEditorCont)
			this.pEditorCont = (bPreload ? document.body : oSt.pBody).appendChild(BX.create("DIV", {props: {className: 'bxst-lhe-cont'}}));

		this.pEditorCont.style.visibility = 'hidden';

		// Editor already loaded
		if (window.oLHESticker)
		{
			if (this.bLoadLHEEditor) // Fist init
			{
				this.PrepareEditorAfterLoading();
				this.bLoadLHEEditor = false;
			}

			if (!bPreload)
				this.DisplayEditor(oSt, Params.ind);
		}
		else if(!this.bLoadLHEEditor) // Init loading
		{
			this.Request('load_lhe', {}, function(res)
			{
				_this.pEditorCont.innerHTML = res;
				var interval = setInterval(function() // Timeout for DOM rendering
				{
					if (typeof window.LoadLHE_LHEBxStickers == 'undefined')
						return;

					clearInterval(interval);

					if (!_this.bLoadLHEEditor && !window.oLHESticker)
						LoadLHE_LHEBxStickers();

					return setTimeout(function()
					{
						_this.bLoadLHEEditor = true;
						_this.ShowEditor(Params);
					}, 50);
				}, 50);
			});
		}
		else if (_this.bLoadLHEEditor && !window.oLHESticker) // Waiting for loading complete
		{
			return setTimeout(function(){_this.ShowEditor(Params);}, 50);
		}
	},

	PrepareEditorAfterLoading: function()
	{
		if (!oLHESticker)
			return;

		oLHESticker.oSpecialParsers['st_title'] = {
			Parse: function(sName, sContent, pLEditor)
			{
				sContent = sContent.replace(/\[ST_TITLE\]((?:\s|\S)*?)\[\/ST_TITLE\]/ig, '<span id="'+ pLEditor.SetBxTag(false, {tag: "st_title"}) + '" class="bxst-title" >$1</span>');
				return sContent;
			},
			UnParse: function(bxTag, pNode, pLEditor)
			{
				var res = "[ST_TITLE]";
				for(i = 0; i < pNode.arNodes.length; i++)
					res += pLEditor._RecursiveGetHTML(pNode.arNodes[i]);
				res += "[/ST_TITLE]";
				return res;
			}
		};

		BX.addCustomEvent(oLHESticker, "OnUnParseContentAfter", function()
		{
			this.__sContent = this.__sContent.replace(/\[\/ST_TITLE\](?:\n|\r)+/ig, "[/ST_TITLE]\n");
		});
	},

	DisplayEditor: function(oSt, ind, bJustDisplay)
	{
		var _this = this;

		if (!bJustDisplay)
		{
			// Append editor
			oSt.pBody.appendChild(this.pEditorCont);
			this.AdjustToSize(ind);
			oLHESticker.SetContent(oSt.obj.content || (this.GetNewStickerContent() + "\n"));
			oLHESticker.CreateFrame(); // We need to recreate editable frame after reappending editor container
			oLHESticker.SetEditorContent(oLHESticker.content);
			window.oLHESticker.pEditorDocument.body.className = this.colorSchemes[oSt.obj.colorInd].name;

			if (this.Params.useHotkeys)
				BX.bind(window.oLHESticker.pEditorDocument, 'keyup', BX.proxy(this.OnKeyUp, this));

			setTimeout(function(){try{window.oLHESticker.pEditorDocument.execCommand("styleWithCSS", false, false);}catch(e){}}, 100);
			setTimeout(function(){try{window.oLHESticker.pEditorDocument.execCommand("styleWithCSS", false, false);}catch(e){}}, 500);
			setTimeout(function(){try{window.oLHESticker.pEditorDocument.execCommand("styleWithCSS", false, false);}catch(e){}}, 1000);

			this.curEditorStickerInd = ind;
			oSt.pBody.style.overflow = 'hidden';

			// Slow div motion for editor loading timeout
			var
				curTop = 0,
				d = 1,
				maxTop = 22;

			var movePanelInterval = setInterval(function()
			{
				if (curTop >= maxTop)
					curTop = maxTop;
				else
					curTop += d;

				oSt.pContentArea.style.top = curTop + "px";
				if (curTop == maxTop)
				{
					clearInterval(movePanelInterval);
					_this.DisplayEditor(oSt, ind, true);
				}
			}, BX.browser.IsIE() ? 5 : 10);
		}
		else
		{
			setTimeout(function()
			{
				oSt.pBody.style.overflow = 'auto';
				_this.pEditorCont.style.visibility = 'visible';
				oSt.pContentArea.style.display = 'none';
				_this.pEditorCont.style.display = 'block';

				setTimeout(function(){oLHESticker.SetFocusToEnd();}, 100);
			}, 100);
		}
	},

	AddToSticker: function(ind)
	{
		var oSt = this.arStickers[ind];
		if (this.curEditorStickerInd === ind && window.oLHESticker)
		{
			oLHESticker.SetFocusToEnd();
			oLHESticker.InsertHTML("<br />" + oLHESticker.ParseContent(this.GetNewStickerContent()) + "<br />");
			setTimeout(function(){oLHESticker.SetFocusToEnd();}, 100);
		}
		else
		{
			oSt.obj.content += "\n" + this.GetNewStickerContent();
			this.ShowEditor({ind: ind});
		}
	},

	Request : function(action, postParams, callBack, bShowWaitWin)
	{
		bShowWaitWin = bShowWaitWin === true;

		if (bShowWaitWin)
			BX.showWait();

		var actionUrl = '/bitrix/admin/fileman_stickers.php?sticker_action=' + action + "&" + this.sessid_get + '&site_id=' + this.Params.site_id;
		return BX.ajax.post(actionUrl, postParams || {},
			function(result)
			{
				if (bShowWaitWin)
					BX.closeWait();

				if(callBack)
					setTimeout(function(){callBack(result);}, 10);
			}
		);
	},

	SetUnselectable: function(arNodes)
	{
		if (typeof arNodes != 'object')
			arNodes = [arNodes];

		for (var i = 0, l = arNodes.length; i < l; i++)
		{
			BX.setUnselectable(arNodes[i]);
			arNodes[i].ondragstart = function (e){return BX.PreventDefault(e);};
		}
	},

	ShowColorOverlay: function(ind, colorInd, bFadeIn)
	{
		var
			_this = this,
			it = 0, interval,
			oSt = this.arStickers[ind];

		if (!this.pColorOverlay)
			this.pColorOverlay = document.body.appendChild(BX.create("DIV", {props: {className: 'bx-sticker-overlay'}}));

		this.pColorOverlay.style.zIndex = parseInt(oSt.pWin.Get().style.zIndex) + 10;
		this.pColorOverlay.style.top = oSt.pWin.Get().style.top;
		this.pColorOverlay.style.left = oSt.pWin.Get().style.left;
		this.pColorOverlay.style.width = oSt.pWin.Get().style.width;
		this.pColorOverlay.style.height = oSt.pWin.Get().style.height;

		interval = setInterval(function()
		{
			if (it > 2)
			{
				if (bFadeIn)
					_this.ChangeColor(ind, colorInd, true, false);
				else
					_this.pColorOverlay.className = 'bx-sticker-overlay';
				return clearInterval(interval);
			}

			if (bFadeIn)
				_this.pColorOverlay.className = 'bx-sticker-overlay bx-sticker-op-' + it;
			else
				_this.pColorOverlay.className = 'bx-sticker-overlay bx-sticker-op-' + (3 -it);

			it++;
		}, 20);
	},

	DisplayStickers: function(bVisEffects)
	{
		for (var i = 0, l = this.Stickers.length; i < l; i++)
			this.AddSticker(this.Stickers[i], bVisEffects);
	},

	MousePos: function (e)
	{
		if(window.event)
			e = window.event;

		if(e.pageX || e.pageY)
		{
			e.realX = e.pageX;
			e.realY = e.pageY;
		}
		else if(e.clientX || e.clientY)
		{
			e.realX = e.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft) - document.documentElement.clientLeft;
			e.realY = e.clientY + (document.documentElement.scrollTop || document.body.scrollTop) - document.documentElement.clientTop;
		}
		return e;
	},

	SaveAndCloseEditor: function(ind, bClose, bSaveSticker)
	{
		if (!window.oLHESticker || this.bLoadLHEEditor)
		{
			var _this = this;
			return setTimeout(function(){_this.SaveAndCloseEditor(ind, bClose);}, 100);
		}

		var oSt = this.arStickers[ind];
		oLHESticker.SaveContent();
		var content = oLHESticker.GetContent();
		var htmlContent = oLHESticker.ParseContent(content);

		oSt.obj.html_content = htmlContent;
		oSt.pContentArea.innerHTML = htmlContent;
		this.arStickers[ind].obj.content = content;

		if (bClose !== false)
		{
			oSt.pContentArea.style.display = 'block';
			this.pEditorCont.style.display = 'none';
			oSt.pContentArea.style.top = '0px';
			oSt.pBody.style.overflow = 'auto';
			this.curEditorStickerInd = false;
		}

		if (bSaveSticker !== false)
			this.SaveSticker(ind);
	},

	GetNewStickerContent: function()
	{
		var zeroInt = function(x)
		{
			x = parseInt(x);
			if (isNaN(x))
				x = 0;
			return x < 10 ? '0' + x.toString() : x.toString();
		}
		var oDate = new Date();
		var strDate = this.Params.strDate + " " + zeroInt(oDate.getHours()) + ':' + zeroInt(oDate.getMinutes());
		return "[ST_TITLE]" + BX.util.htmlspecialchars(this.Params.curUserName) + ' ' + strDate + "[/ST_TITLE]\n";
	},

	SaveSticker: function(ind)
	{
		if (this.access == 'R') // Readonly
			return;

		if (this.curEditorStickerInd === ind)
			this.SaveAndCloseEditor(ind, false, false);

		var oSt = this.arStickers[ind];
		var _this = this;
		var reqid = Math.round(Math.random() * 100000);
		window.__bxst_result[reqid] = false;

		if (typeof oSt.obj.content == 'undefined')
			oSt.obj.content = this.GetNewStickerContent() + "\n";

		if (oSt.obj.bNew)
		{
			if (this._arSavedStickers[ind]) // prevent double saving
				return;
			this._arSavedStickers[ind] = true;
		}

		this.Request('save_sticker',
			{
				reqid : reqid,
				id: oSt.obj.bNew ? 0 : oSt.obj.id,
				page_url: this.Params.pageUrl,
				page_title: this.Params.pageTitle,

				personal: oSt.obj.personal ? 'Y' : 'N',
				content: oSt.obj.content,

				width: oSt.obj.width,
				height: oSt.obj.height,
				top: oSt.obj.top,
				left: oSt.obj.left,
				color: oSt.obj.colorInd,

				collapsed: oSt.obj.collapsed ? 'Y' : 'N',
				completed: oSt.obj.completed ? 'Y' : 'N',
				closed: oSt.obj.closed ? 'Y' : 'N',

				marker: oSt.obj.marker
			},
			function()
			{
				if (window.__bxst_result[reqid])
				{
					var bNew = !!oSt.obj.bNew;
					_this.arStickers[ind].obj = _this.ConvertStickerObj(window.__bxst_result[reqid]);
					if (_this.arStickers[ind].pHint)
					{
						_this.arStickers[ind].pHint.HINT = _this.arStickers[ind].obj.info;
						if (_this.arStickers[ind].pHint.CONTENT_TEXT)
							_this.arStickers[ind].pHint.CONTENT_TEXT.innerHTML = _this.arStickers[ind].obj.info;
					}

					if (bNew)
					{
						_this.UpdateNewSticker(ind);

						if (!_this.arStickers[ind].obj.closed)
						{
							_this.curPageCount++;
							_this.UpdateStickersCount();
						}
					}
					else
					{
						if (_this.arStickers[ind].obj.closed)
						{
							_this.curPageCount--;
							_this.UpdateStickersCount();
						}
					}
				}
				window.__bxst_result[reqid] = null;
			}
		);
	},

	GetCollapsedContent: function(content)
	{
		var colContent = '';
		if (content.indexOf('bxst-title') != -1)
		{
			colContent = content.replace(/<span[^>]*?class="bxst-title"[^>]*?>((?:\s|\S)*?)<\/span>/ig, function(str, title)
			{
				if (title.indexOf(String.fromCharCode(160)) > 0)
					return '<span class="bxst-title">' + title.substr(0, title.indexOf(String.fromCharCode(160))) + "</span> ";
				return title;
			});

			colContent = colContent.replace(/<br( \/)?>/ig, ' ');
		}
		// else
		// {

		// }

		if (colContent != '')
			return colContent;

		return content;
	},

	ConvertStickerObj: function(Sticker)
	{
		return {
			bNew: false,
			id: parseInt(Sticker.ID),
			personal: Sticker.PERSONAL == 'Y',
			colorInd: Sticker.COLOR || 0,
			content: Sticker.CONTENT,
			html_content: Sticker.HTML_CONTENT,
			top: parseInt(Sticker.POS_TOP),
			left: parseInt(Sticker.POS_LEFT),
			width: parseInt(Sticker.WIDTH),
			height: parseInt(Sticker.HEIGHT),
			collapsed: Sticker.COLLAPSED == 'Y',
			completed: Sticker.COMPLETED == 'Y',
			closed: Sticker.CLOSED == 'Y',
			info: Sticker.INFO,
			authorName: Sticker.AUTHOR,
			authorId: Sticker.CREATED_BY,
			marker: (Sticker.MARKER_ADJUST || Sticker.MARKER_WIDTH || Sticker.MARKER_HEIGHT)  ?
				{
					top: parseInt(Sticker.MARKER_TOP),
					left: parseInt(Sticker.MARKER_LEFT),
					width: parseInt(Sticker.MARKER_WIDTH),
					height: parseInt(Sticker.MARKER_HEIGHT),
					adjust: Sticker.MARKER_ADJUST
				}
				: {}
		};
	},

	SetMarker: function(ind, mode)
	{
		var _this = this;
		var oSt = this.arStickers[ind];
		this.bHightlightElementMode = false;
		this.bSelectAreaMode = false;

		BX.removeClass(oSt.pMarkerElementBut, 'bxst-pressed');
		BX.removeClass(oSt.pMarkerAreaBut, 'bxst-pressed');

		if (!this.oMarker)
			this.oMarker = {};

		this.oMarker.StickerInd = ind;

		//Hide marker if it exist
		if (oSt.pMarkerNode)
			BX.removeClass(oSt.pMarkerNode, 'bxst-sicked');

		if (oSt.pMarker)
		{
			oSt.pMarker.style.display = "none";
			oSt.pMarker.style.top = "-1000px";
		}
		if (oSt.markerResizer && oSt.markerResizer.cont)
			oSt.markerResizer.cont.style.display = "none";

		if (oSt.obj && oSt.obj.marker)
			oSt.obj.marker = {};

		this.oMarker.node = null;

		oSt.bSetMarkerMode = true;
		if (mode == 'area')
		{
			BX.addClass(oSt.pMarkerAreaBut, 'bxst-pressed');
			setTimeout(function(){_this.bSelectAreaMode = true;}, 10);

			// Create overlay
			if (!this.oMarker.pOverlay)
				this.oMarker.pOverlay = document.body.appendChild(BX.create('DIV', {props: {className: 'bxst-marker-overlay'}}));
			// Show overlay
			this.oMarker.pOverlay.style.display = 'block';

			// Adjust overlay to size
			var ss = BX.GetWindowScrollSize(document);
			this.oMarker.pOverlay.style.width = ss.scrollWidth + "px";
			this.oMarker.pOverlay.style.height = ss.scrollHeight + "px";

			// Create hint near cursor
			if (!this.oMarker.pCursorHint)
				this.oMarker.pCursorHint = document.body.appendChild(BX.create('DIV', {props: {className: 'bxst-cursor-hint'}, text: this.MESS.CursorHint}));

			this.oMarker.pCursorHint.style.top = '';
			this.oMarker.pCursorHint.style.left = '';
			this.oMarker.pCursorHint.style.display = 'block';

			// Marker selection area object
			this.oMarker.pWnd = document.body.appendChild(BX.create('DIV'));
			this.oMarker.pWnd.className = 'bxst-cur-marker ' + this.colorSchemes[oSt.obj.colorInd].name;
		}
		else // Element
		{
			BX.addClass(oSt.pMarkerElementBut, 'bxst-pressed');
			setTimeout(function(){_this.bHightlightElementMode = true;}, 10);
		}

		// Add events
		BX.bind(document, 'mousemove', BX.proxy(this.OnMouseMove, this));
		//BX.bind(document, 'mousedown', BX.proxy(this.OnMousedown, this));
		BX.bind(document, 'mouseup', BX.proxy(this.OnMouseUp, this));
	},

	OnMousedown: function(e)
	{
		//if(!this.bHightlightElementMode && !this.bSelectAreaMode)
		//{
			if (this.curEditorStickerInd !== false && window.oLHESticker && !window.oLHESticker.bPopup)
			{
				var oSt = this.arStickers[this.curEditorStickerInd];
				if (oSt && oSt.pWin.Get())
				{
					var
						bSelMode = this.bSelectAreaMode || this.bHightlightElementMode,
						d = 3,
						top = parseInt(oSt.pWin.Get().style.top) - d,
						left = parseInt(oSt.pWin.Get().style.left) - d,
						right = left + parseInt(oSt.pWin.Get().style.width) + d * 2,
						bottom = top + parseInt(oSt.pWin.Get().style.height) + d * 2;

					e = this.MousePos(e);
					if (e.realX < left || e.realX > right || e.realY < top || e.realY > bottom)
						this.SaveAndCloseEditor(this.curEditorStickerInd, !bSelMode, !bSelMode);
				}
			}
		//}

		// Start to draw selection marker area
		if (this.bSelectAreaMode)
		{
			e = this.MousePos(e);
			this.bDrawMarkerMode = true;
			if (this.oMarker.pCursorHint)
				this.oMarker.pCursorHint.style.display = 'none';

			this.oMarker.from = {top: e.realY, left: e.realX};
		}
		else if (this.bHightlightElementMode) // Start to draw marker area
		{
			var bPrevent = false;
			if (this.pCurMarkeredNode)
			{
				bPrevent = true;
				var cn = this.pCurMarkeredNode.pNode.className;
				if (cn && (cn.indexOf('bx-sticker') != -1 || cn.indexOf('bxst') != -1) && cn.indexOf('bxst-sicked') == -1)
					bPrevent = false;
				if (bPrevent)
					bPrevent = !BX.findParent(this.pCurMarkeredNode.pNode, {className: new RegExp('bx-sticker', 'ig')});
			}

			// Prevent to go away from page
			if (bPrevent)
				return BX.PreventDefault(e);
			else
				this.MarkerHightlightNode(); // Restore onmousedown and onclick events
		}
	},

	OnMouseMove: function(e)
	{
		if(this.bHightlightElementMode)
		{
			var pEl;
			if (e.target)
				pEl = e.target;
			else if (e.srcElement)
				pEl = e.srcElement;
			if (pEl.nodeType == 3)
				pEl = pEl.parentNode;

			if (pEl && pEl.nodeName)
				this.MarkerHightlightNode(pEl);
		}

		if (this.bSelectAreaMode)
		{
			e = this.MousePos(e);

			if (this.oMarker.pCursorHint)
				this.AdjustHintToCursor(this.oMarker.pCursorHint, e);

			if (!this.bDrawMarkerMode)
				return;

			// We down mouse button and try to drop: unhightlight element and start to select area
			//this.bHightlightElementMode = false;
			//this.MarkerHightlightNode();

			this.oMarker.to = {top: e.realY, left: e.realX};
			var
				top = this.oMarker.from.top,
				left = this.oMarker.from.left,
				w = Math.abs(this.oMarker.to.left - this.oMarker.from.left),
				h = Math.abs(this.oMarker.to.top - this.oMarker.from.top);

			//00.00 - 3.00
			if (this.oMarker.to.top <= this.oMarker.from.top && this.oMarker.to.left >= this.oMarker.from.left)
			{
				top = this.oMarker.to.top;
				left = this.oMarker.from.left;
			}
			// 3.00 - 6.00
			else if (this.oMarker.to.top > this.oMarker.from.top && this.oMarker.to.left > this.oMarker.from.left)
			{
				top = this.oMarker.from.top;
				left = this.oMarker.from.left;
			}
			// 6.00 - 9.00
			else if (this.oMarker.to.top > this.oMarker.from.top && this.oMarker.to.left < this.oMarker.from.left)
			{
				top = this.oMarker.from.top;
				left = this.oMarker.to.left;
			}
			// 9.00 - 12.00
			else if (this.oMarker.to.top < this.oMarker.from.top && this.oMarker.to.left < this.oMarker.from.left)
			{
				top = this.oMarker.to.top;
				left = this.oMarker.to.left;
			}

			this.oMarker.pWnd.style.display = "block";
			this.oMarker.pWnd.style.width = w + "px";
			this.oMarker.pWnd.style.height = h + "px";
			this.oMarker.pWnd.style.top = top + "px";
			this.oMarker.pWnd.style.left = left + "px";

			this.oMarker.top = top;
			this.oMarker.left = left;
			this.oMarker.width = w;
			this.oMarker.height = h;
		}
	},

	OnMouseUp: function(e)
	{
		if (this.bHightlightElementMode && this.pCurMarkeredNode)
		{
			var bPrevent = false;
			var cn = this.pCurMarkeredNode.pNode.className;
			if (cn && (cn.indexOf('bx-sticker') != -1 || cn.indexOf('bxst') != -1) && cn.indexOf('bxst-sicked') == -1)
				bPrevent = true;
			if (!bPrevent)
				bPrevent = !!BX.findParent(this.pCurMarkeredNode.pNode, {className: new RegExp('bx-sticker', 'ig')});

			if (!bPrevent)
				this.oMarker.node = this.pCurMarkeredNode.pNode;
		}

		// Reset
		this.bDrawMarkerMode = false;
		this.bHightlightElementMode = false;
		this.bSelectAreaMode = false;

		if (this.oMarker.StickerInd >= 0 && this.arStickers[this.oMarker.StickerInd])
		{
			var oSt = this.arStickers[this.oMarker.StickerInd];
			BX.removeClass(oSt.pMarkerElementBut, 'bxst-pressed');
			BX.removeClass(oSt.pMarkerAreaBut, 'bxst-pressed');
			oSt.bSetMarkerMode = false;
		}

		// Kill events
		BX.unbind(document, 'mousemove', BX.proxy(this.OnMouseMove, this));
		//BX.unbind(document, 'mousedown', BX.proxy(this.OnMousedown, this));
		BX.unbind(document, 'mouseup', BX.proxy(this.OnMouseUp, this));

		if (this.oMarker.pOverlay)
			this.oMarker.pOverlay.style.display = 'none';
		if (this.oMarker.pCursorHint)
			this.oMarker.pCursorHint.style.display = 'none';

		// if (bPrevent)
			// this.SetMarker(this.oMarker.StickerInd);
		// else
		if (!bPrevent)
			this.CreateMarker(this.oMarker);
	},

	MarkerHightlightNode: function(node)
	{
		if (this.pCurMarkeredNode)
		{
			if (this.pCurMarkeredNode.onclick)
				this.pCurMarkeredNode.pNode.onclick = this.pCurMarkeredNode.onclick;
			if (this.pCurMarkeredNode.onmousedown)
				this.pCurMarkeredNode.pNode.onmousedown = this.pCurMarkeredNode.onmousedown;

			BX.removeClass(this.pCurMarkeredNode.pNode, 'bxst-sicked');
		}

		if (node)
		{
			this.pCurMarkeredNode = {pNode: node};

			if (node.onclick)
				this.pCurMarkeredNode.onclick = node.onclick;
			if (node.onmousedown)
				this.pCurMarkeredNode.onmousedown = node.onmousedown;

			node.onmousedown = BX.proxy(this.OnMousedown, this);
			node.onclick = function(){return BX.PreventDefault(arguments[0]);};

			BX.addClass(node, 'bxst-sicked');
		}
		else
		{
			this.pCurMarkeredNode = false;
		}
	},

	CreateMarker: function(oMarker)
	{
		if (!oMarker)
			return;

		var oSt = this.arStickers[oMarker.StickerInd];

		if (oMarker.node)
		{
			oSt.pMarkerNode = oMarker.node;
			oSt.obj.marker = {adjust: this.GetNodeAdjustInfo(oMarker.node)};

			var pos = BX.pos(oSt.pMarkerNode);
			if (pos)
			{
				oSt.obj.marker.top = pos.top - 2;
				oSt.obj.marker.left = pos.left - 2;
				oSt.obj.marker.width = pos.width - 4;
				oSt.obj.marker.height = pos.height - 4;
			}
		}
		else
		{
			oSt.obj.marker = {
				top: oMarker.top,
				left: oMarker.left,
				width: oMarker.width,
				height: oMarker.height
			};

			this.InitMagicAdjust(oMarker.StickerInd);
		}

		if (oSt.obj.marker && (oSt.obj.marker.adjust || (oSt.obj.marker.width && oSt.obj.marker.height && oSt.obj.marker.top && oSt.obj.marker.left)))
		{
			this.DisplayMarker(oMarker.StickerInd, true);
			this.AdjustStickerToArea(oMarker.StickerInd);
		}

		if (this.oMarker.pWnd)
			this.oMarker.pWnd.style.display = "none";

		if (!oSt.pWin.__stWasDragged)
			this.SaveSticker(oMarker.StickerInd);
	},

	DisplayMarker: function(ind, bNew)
	{
		var oSt = this.arStickers[ind];
		if (oSt.pMarker)
			oSt.pMarker.style.display = "none";

		if (oSt.obj.marker && oSt.obj.marker.adjust)
		{
			if (!oSt.pMarkerNode)
				oSt.pMarkerNode = this.FindMarkerNode(oSt.obj.marker.adjust);

			if (oSt.pMarkerNode)
			{
				var pos = BX.pos(oSt.pMarkerNode);
				if (pos)
				{
					if (!oSt.pMarker)
						oSt.pMarker = document.body.appendChild(BX.create('DIV', {props: {className: 'bxst-sticker-marker ' + this.colorSchemes[oSt.obj.colorInd].name}}));

					if (bNew)
						BX.addClass(oSt.pMarker, "bxst-marker-over");

					oSt.pMarker.style.display = "";
					oSt.pMarker.style.width = (pos.width - 4) + "px";
					oSt.pMarker.style.height = (pos.height - 4) + "px";
					oSt.pMarker.style.top = (pos.top - 2) + "px";
					oSt.pMarker.style.left = (pos.left - 2) + "px";
				}

				//return BX.addClass(oSt.pMarkerNode, 'bxst-sicked'); // We find node and select it
				BX.removeClass(oSt.pMarkerNode, 'bxst-sicked');
				return; // We find node and select it
			}
		}

		// Select area
		if (oSt.obj.marker && oSt.obj.marker.width > 0)
		{
			if (!oSt.pMarker)
				oSt.pMarker = document.body.appendChild(BX.create('DIV', {props: {className: 'bxst-sticker-marker ' + this.colorSchemes[oSt.obj.colorInd].name}}));

			if (bNew)
				BX.addClass(oSt.pMarker, "bxst-marker-over");

			oSt.pMarker.style.display = "";
			oSt.pMarker.style.width = oSt.obj.marker.width + "px";
			oSt.pMarker.style.height = oSt.obj.marker.height + "px";
			oSt.pMarker.style.top = oSt.obj.marker.top + "px";
			oSt.pMarker.style.left = oSt.obj.marker.left + "px";
		}
	},

	InitMagicAdjust: function(ind)
	{
		return;

		if (!this.magicNodes)
		{
			var arLinks = document.getElementsByTagName('A');
			// var arImgs = document.getElementsByTagName('IMG');
			// var arDivs = document.getElementsByTagName('DIV');


			var i, len, el, nodes = [], w, h, t, l;

			//
			len = arLinks.length;

			for (i = 0; i < len; i++)
			{
				//w = arLinks[i].offsetWidth;
				//h = arLinks[i].offsetHeight;
				// t = arLinks[i].offsetTop;
				// l = arLinks[i].offsetLeft;

				//console.info(w, h, t, l);

				//if (w > 0 && h > 0 && t > 0 && l > 0)
				if (arLinks[i].offsetWidth > 0)
				{
					var pos = BX.pos(arLinks[i]);
					nodes.push({el: arLinks[i], pos: pos});

					//nodes.push({el: arLinks[i], w: w, h: h, t: t, l: l, r: l + w, b: t + h});
				}
			}

			this.magicNodes = {
				nodes: nodes
			};
		}

		//return;
		var
			node,
			oSt = this.arStickers[ind],
			mTop = oSt.obj.marker.top,
			mLeft = oSt.obj.marker.left,
			mWidth = oSt.obj.marker.width,
			mHeight = oSt.obj.marker.height,
			mRight = mLeft + mWidth,
			mBottom = mTop + mHeight;

		len = this.magicNodes.nodes.length;
		for (i = 0; i < len; i++)
		{
			node = this.magicNodes.nodes[i];
			// if (node.el.id == 'ch1')
				// console.dir(node);

			if (node.pos.top >= mTop && node.pos.left >= mLeft && node.pos.right <= mRight && node.pos.bottom <= mBottom)
			{
				//console.info(node.el);
			}
		}

		// oSt.obj.marker = {
			// top: oMarker.top,
			// left: oMarker.left,
			// width: oMarker.width,
			// height: oMarker.height
		// };
	},

	GetNodeAdjustInfo: function(node)
	{
		var nodeInfo = this._GetNodeAdjustInfo(node);
		nodeInfo = this._GetNodeAdjustSiblings(node, nodeInfo);
		return nodeInfo;
	},

	_GetNodeAdjustInfo: function(node)
	{
		var nodeInfo = {
			nodeName: node.nodeName.toLowerCase(),
			attr: {},
			innerHTML: null
		};

		if (node.innerHTML && node.innerHTML.length)
		{
			nodeInfo.innerHTML = BX.util.trim(node.innerHTML.toLowerCase());

			nodeInfo.innerHTML = nodeInfo.innerHTML.replace(/class=""/ig, '');
			nodeInfo.innerHTML = nodeInfo.innerHTML.replace(/class=''/ig, '');
			nodeInfo.innerHTML = nodeInfo.innerHTML.replace(/\n+/ig, '');
			nodeInfo.innerHTML = nodeInfo.innerHTML.replace(/\r+/ig, '');
			nodeInfo.innerHTML = nodeInfo.innerHTML.replace(/\s+/ig, ' ');

			if (nodeInfo.innerHTML.length > 250)
				nodeInfo.innerHTML = nodeInfo.innerHTML.substr(0, 250);
		}

		if (node.attributes)
		{
			var i, l = node.attributes.length;
			for (i = 0; i < l; i++)
			{
				name = node.attributes[i].name;
				if (!name || typeof name != 'string')
					continue;
				name = name.toLowerCase();
				if (this.oMarkerConfig.attr[name])
				{
					val = node.attributes[i].value;
					if (name == 'class' || name == 'classname')
					{
						name = 'classname';
						val = val.replace('bxst-sicked', '');
						val = BX.util.trim(val);
					}

					if (val.length > 0)
						nodeInfo.attr[name] = val;
				}
			}
		}
		return nodeInfo;
	},

	_GetNodeAdjustSiblings: function(node, nodeInfo)
	{
		nodeInfo.withId = {};

		var pParent = BX.findParent(node, {attr : {id: new RegExp('.+', 'ig')}});
		if (pParent)
			nodeInfo.withId.parent = pParent.getAttribute('id');

		var pChildren = BX.findChild(node, {attr : {id: new RegExp('.+', 'ig')}}, true, true);
		if (pChildren)
		{
			nodeInfo.withId.children = [];
			for (var i = 0, l = pChildren.length; i < l; i++)
				nodeInfo.withId.children.push(pChildren[i].getAttribute('id'));
		}

		var pPrevSibling = BX.findPreviousSibling(node, {attr : {id: new RegExp('.+', 'ig')}});
		if (pPrevSibling)
			nodeInfo.withId.prevSibling = pPrevSibling.getAttribute('id');

		var pNextSibling = BX.findNextSibling(node, {attr : {id: new RegExp('.+', 'ig')}});
		if (pNextSibling)
			nodeInfo.withId.nextSibling = pNextSibling.getAttribute('id');

		return nodeInfo;
	},

	FindMarkerNode: function(nodeInfo)
	{
		var node = false;
		if (!nodeInfo || !nodeInfo.nodeName)
			return false;

		if (!nodeInfo.attr)
			nodeInfo.attr = {};

		// Simple and easy way
		if (nodeInfo.attr.id)
			node = BX(nodeInfo.attr.id);

		var arFindedNodes = [];
		var res;

		if (!node)
		{
			if (!nodeInfo.withId)
				nodeInfo.withId = {};

			// Find by prev sibling
			if (nodeInfo.withId.prevSibling)
			{
				var nextNode = BX(nodeInfo.withId.prevSibling);
				if (nextNode)
				{
					while(nextNode = nextNode.nextSibling)
					{
						res = this.TestNodeWithAttributes(nextNode, nodeInfo);
						if (res)
							arFindedNodes.push(res);

						if (res.coincide == 100)
							break;
					}
				}
			}

			// Find by next sibling
			if (nodeInfo.withId.nextSibling)
			{
				var prevNode = BX(nodeInfo.withId.nextSibling);
				if (prevNode)
				{
					while(prevNode = prevNode.previousSibling)
					{
						res = this.TestNodeWithAttributes(prevNode, nodeInfo);
						if (res)
							arFindedNodes.push(res);

						if (res.coincide == 100)
							break;
					}
				}
			}

			// Find by child
			if (nodeInfo.withId.children)
			{
				var i, l = nodeInfo.withId.children.length, child, parNode;
				for (i = 0; i < l; i++)
				{
					child = BX(nodeInfo.withId.children[i]);
					if (child)
					{
						parNode = child;
						while (true)
						{
							parNode = BX.findParent(parNode, {tagName: nodeInfo.nodeName});
							if (!parNode)
								break;

							res = this.TestNodeWithAttributes(prevNode, nodeInfo);
							if (res)
								arFindedNodes.push(res);

							if (res.coincide == 100)
								break;
						}
					}
				}
			}

			// Find by parent
			var parent;
			if (nodeInfo.withId.parent)
				parent = BX(nodeInfo.withId.parent);
			if (!parent)
				parent = document.body;

			var arAllNodes = parent.getElementsByTagName(nodeInfo.nodeName);
			var i, l = arAllNodes.length;
			for (i = 0; i < l; i++)
			{
				res = this.TestNodeWithAttributes(arAllNodes[i], nodeInfo);
				if (res)
					arFindedNodes.push(res);
				if (res.coincide == 100)
					break;
			}
		}
		else
		{
			arFindedNodes.push({coincide: 100, node: node, bImpAttrCoincide: true});
		}

		var i, l = arFindedNodes.length;
		var arRealNodes = [], maxCoincide = 0, mostRealNode = false;

		for (i = 0; i < l; i++)
		{
			if (arFindedNodes[i].coincide > maxCoincide)
			{
				maxCoincide = arFindedNodes[i].coincide;
				mostRealNode = arFindedNodes[i].node;
				arRealNodes = [];
			}

			if (arFindedNodes[i].coincide == maxCoincide && arFindedNodes[i].node != mostRealNode)
				arRealNodes.push(arFindedNodes[i].node);
		}

		if (arRealNodes.length == 0 && mostRealNode)
			return mostRealNode;
		else
			arRealNodes[0];

		return false;
	},

	TestNodeWithAttributes: function(pNode, nodeInfo)
	{
		if (!pNode || !pNode.nodeName)
			return false;

		var res = {coincide: 0, node: pNode};
		var info = this._GetNodeAdjustInfo(pNode);

		if (info.nodeName != nodeInfo.nodeName)
			return false;

		var delta = 0;
		var bInnerHTML = typeof nodeInfo.innerHTML == 'string';
		if (typeof info.innerHTML != 'string' && bInnerHTML)
			return false;

		var count = 0;
		for (i in nodeInfo.attr)
			if (typeof nodeInfo.attr[i] == 'string')
				count++;

		if (count > 0)
		{
			delta = 100 / (count + (bInnerHTML ? 1 : 0));
			var bImpAttrCoincide = true;

			for (i in nodeInfo.attr)
			{
				if (typeof nodeInfo.attr[i] == 'string')
				{
					// We have similar attributes
					if (nodeInfo.attr[i] == info.attr[i])
						res.coincide += delta;
					else if (this.oMarkerConfig.impAttr[i])
						bImpAttrCoincide = false;
				}
			}

			res.bImpAttrCoincide = bImpAttrCoincide;
		}

		if (bInnerHTML && info.innerHTML == nodeInfo.innerHTML)
			res.coincide += count > 0 ? delta : 95;
		res.coincide = Math.round(res.coincide);

		if (res.coincide > 0)
			return res;
		return false;
	},

	OnDivMouseOver: function(ind, bOver)
	{
		var oSt = this.arStickers[ind];
		if (oSt.bSetMarkerMode)
			return this.ShowButtonsPanel(ind, true, false);

		oSt._over = bOver;

		if (oSt._overTimeout)
			clearTimeout(oSt._overTimeout);

		var _this = this;
		oSt._overTimeout = setTimeout(function()
		{
			if (oSt._over == bOver)
			{
				_this.ShowButtonsPanel(ind, bOver);
				_this.Hightlight(ind, bOver);
			}
		}, bOver ? 100 : 500);
	},

	ShowButtonsPanel: function(ind, bShow, bEffects)
	{
		if (!this.Params.bHideBottom)
		{
			bShow = true;
			bEffects = false;
		}

		bEffects = bEffects !== false;

		var
			_this = this,
			oSt = this.arStickers[ind],
			h = 24, d = 3, i = 1,
			curHeight = oSt.obj.height - (oSt.bButPanelShowed ? 0 : h),
			resHeight = curHeight + h * (bShow ? 1 : -1),
			time = BX.browser.IsIE() ? 3 : 10;

		if (this.bSelectAreaMode || this.bHightlightElementMode // Set marker mode
		|| oSt.obj.collapsed || oSt.obj.closed || oSt.bColSelShowed || oSt.bResizingNow) // Sticker params
			return;

		if (oSt.bButPanelShowed == bShow)
		{
			oSt.pWin.Get().style.height = curHeight + 'px';
			return this.AdjustShadow(ind);
		}

		var sbpInterval = setInterval(function()
		{
			curHeight += d * i * (bShow ? 1 : -1 );
			if (bShow && curHeight >= resHeight || !bShow && curHeight <= resHeight)
				curHeight = resHeight;

			oSt.pWin.Get().style.height = curHeight + 'px';
			_this.AdjustShadow(ind);

			if (curHeight == resHeight)
			{
				clearInterval(sbpInterval);
				oSt.bButPanelShowed = bShow;
			}

			i++;
		}, time);
	},

	ShowColorSelector: function(ind)
	{
		var
			_this = this,
			oSt = this.arStickers[ind], b;

		if (!oSt)
			return;

		if (!oSt.pColSelector)
		{
			oSt.pColSelector = document.body.appendChild(BX.create("DIV", {props: {className: 'bxst-col-sel'}}));
			for (var i = 0, l = this.colorSchemes.length; i < l; i++)
			{
				b = oSt.pColSelector.appendChild(BX.create("SPAN", {props: {id: 'bxst_' + ind + '_' + i, className: 'bxst-col-pic ' + this.colorSchemes[i].name, title: this.colorSchemes[i].title}}));
				b.onclick = function(){
					_this.ChangeColor(ind, parseInt(this.id.substr(('bxst_' + ind + '_').length)), true, true);
					_this.ShowColorSelector(ind); // Hide
				};
			}
			oSt.pColSelector.style.zIndex = this.Params.zIndex + 20;
		}

		oSt.bColSelShowed = !oSt.bColSelShowed;
		if (oSt.bColSelShowed)
		{
			var pos = BX.pos(oSt.pColorBut);
			oSt.pColSelector.style.top = (parseInt(pos.top) + 16) + "px";
			oSt.pColSelector.style.left = (pos.left) + "px";
			oSt.pColSelector.style.display = "block";

			this.ShowOverlay(true, this.Params.zIndex + 15);
			this.pTransOverlay.onmousedown = function(){_this.ShowColorSelector(ind);};
			BX.bind(document, 'keydown', BX.proxy(function(e){this.OnKeyDown(e, ind);}, this));
		}
		else //hide
		{
			oSt.pColSelector.style.display = "none";
			this.ShowOverlay(false);
			BX.unbind(document, 'keydown', BX.proxy(function(e){this.OnKeyDown(e, ind);}, this));
		}
	},

	ShowOverlay: function(bShow, zIndex)
	{
		if (!this.pTransOverlay)
			this.pTransOverlay = document.body.appendChild(BX.create('DIV', {props: {className: 'bxst-trans-overlay'}}));

		if (bShow)
		{
			this.pTransOverlay.style.display = "block";
			this.pTransOverlay.style.zIndex = zIndex || 800;

			// Adjust overlay to size
			var ss = BX.GetWindowScrollSize(document);
			this.pTransOverlay.style.width = ss.scrollWidth + "px";
			this.pTransOverlay.style.height = ss.scrollHeight + "px";
		}
		else
		{
			this.pTransOverlay.style.display = "none";
			this.pTransOverlay.onmousedown = BX.False;
		}
	},

	OnKeyDown: function(e, ind)
	{
		if(!e)
			e = window.event;

		var key = e.which || e.keyCode;
		if (key == 27) // Esc
		{
			var oSt = this.arStickers[ind];
			if (oSt && oSt.bColSelShowed)
				this.ShowColorSelector(ind); // Hide
		}
	},

	SupaFlySticker: function()
	{
		return;
		var windowSize = BX.GetWindowInnerSize();

		var
			st_w = 350, // Sticker width
			st_h = 200, // sticker height
			st_left = 1125, // sticker left
			st_top = 100, // Sticker top
			st_x = Math.round(st_left + st_w / 2), // Sticker center X
			st_y = Math.round(st_top + st_h / 2), // Sticker center Y
			win_w = windowSize.innerWidth,
			win_h = windowSize.innerHeight,
			x0 = Math.round(win_w / 2),
			y0 = Math.round(win_h / 2);

		// console.info('x0 = ', x0, 'y0 = ', y0);
		// console.info('st_x = ', st_x, 'st_y = ', st_y);

		// A * x + B * y + C = 0
		var A = y0 - st_y;
		var B = st_x - x0;
		var C = (x0 * st_y) - (y0 * st_x);

		//console.info('A = ', A, 'B = ', B, 'C = ', C);

		//var start_x = win_w;
		//var start_y = - (C + A * start_x) / B;
		//console.info(start_x, start_y);
		//var k = st_x / st_y;
		//console.info(k);

		//Center
		var div = document.body.appendChild(BX.create("DIV", {style: {background: "#00f", position: "absolute", width: "5px", height: "5px", zIndex: 2000}}));
		div.style.left = x0 + "px";
		div.style.top = y0 + "px";

		//Center
		var div = document.body.appendChild(BX.create("DIV", {style: {background: "#0f0", position: "absolute", width: "5px", height: "5px", zIndex: 2000}}));
		div.style.left = st_x + "px";
		div.style.top = st_y + "px";

		//return;
		// var x = x0;
		// for (var i = 0; i < 200; i++)
		// {
			// var div = document.body.appendChild(BX.create("DIV", {style: {background: "red", position: "absolute", width: "2px", height: "2px", zIndex: 2000}}));

			// var start_x = x;
			// var start_y = - (C + A * start_x) / B;

			// div.style.left = Math.round(start_x) + "px";
			// div.style.top = Math.round(start_y) + "px";

			// x += 10;
			// //console.info(div);
		// }

		// var start_x = win_w;
		// var start_y = - (C + A * start_x) / B;

		var start_y = 0;
		var start_x = - (C + B * start_y) / A;

		var div = document.body.appendChild(BX.create("DIV", {style: {background: "red", position: "absolute", width: "10px", height: "10px", zIndex: 2000}}));
		div.style.left = start_x + "px";
		div.style.top = start_y + "px";
		//console.info(div);

		return;
		//var start_x = Math.round((win_w + st_w) / 2  + win_w / 2);
		var start_x = win_w;
		var start_y = Math.round(start_x / k - win_h / 2);

		var start_left = Math.round(start_x + st_w / 2);
		var start_top = Math.round(start_y - st_h / 2);

		var div = document.body.appendChild(BX.create("DIV", {style: {background: "#ffff80", position: "absolute", width: st_w + "px", height: st_h + "px", zIndex: 2000}}));

		div.style.left = start_left + "px";
		div.style.top = start_top + "px";
	},

	Hightlight: function(ind, bOver)
	{
		var
			oSt = this.arStickers[ind];

		if (oSt.bOver === bOver)
			return;

		oSt.bOver = bOver;
		if (bOver)
		{
			if (oSt.pMarker)
				BX.addClass(oSt.pMarker, "bxst-marker-over");

			BX.addClass(oSt.pWin.Get(), "bx-sticker-over");
			BX.addClass(oSt.pHead, "bxst-header-over");

			oSt.pWin.Get().style.top = (parseInt(oSt.pWin.Get().style.top) - 1) + "px";
			oSt.pWin.Get().style.left = (parseInt(oSt.pWin.Get().style.left) - 1) + "px";
		}
		else
		{
			if (oSt.pMarker)
				BX.removeClass(oSt.pMarker, "bxst-marker-over");

			BX.removeClass(oSt.pWin.Get(), "bx-sticker-over");
			BX.removeClass(oSt.pHead, "bxst-header-over");
			oSt.pWin.Get().style.top = (parseInt(oSt.pWin.Get().style.top) + 1) + "px";
			oSt.pWin.Get().style.left = (parseInt(oSt.pWin.Get().style.left) + 1) + "px";
		}
	},

	BlinkRed: function(ind)
	{
		var
			_this = this,
			rep = 4,
			it = 0, it0 =0, interval,
			oSt = this.arStickers[ind];

		if (!this.pBlinkRed)
			this.pBlinkRed = document.body.appendChild(BX.create("DIV", {props: {className: 'bxst-blink-red'}}));

		this.pBlinkRed.style.zIndex = parseInt(oSt.pWin.Get().style.zIndex) + 10;
		this.pBlinkRed.style.top = oSt.pWin.Get().style.top;
		this.pBlinkRed.style.left = oSt.pWin.Get().style.left;
		this.pBlinkRed.style.width = oSt.pWin.Get().style.width;
		this.pBlinkRed.style.height = oSt.pWin.Get().style.height;

		bFadeIn = true;
		interval = setInterval(function()
		{
			if (it > 2)
			{
				if (bFadeIn)
				{
					_this.pBlinkRed.className = 'bxst-blink-red bx-sticker-op-3';
					it = 1;
				}
				else
				{
					_this.pBlinkRed.className = 'bxst-blink-red';
					it = 0;
				}

				it0++;
				bFadeIn = !bFadeIn;
				if (it0 >= rep)
					clearInterval(interval);

				return;
			}

			if (bFadeIn)
				_this.pBlinkRed.className = 'bxst-blink-red bx-sticker-op-' + it;
			else
				_this.pBlinkRed.className = 'bxst-blink-red bx-sticker-op-' + (3 - it);
			it++;
		}, BX.browser.IsIE() ? 30 : 60);
	},

	ShowList: function(type)
	{
		if (!this.List)
			this.List = new BXStickerList(this);

		this.List.Show(type);
	},

	OnKeyUp: function(e)
	{
		if(!e)
			e = window.event;

		var key = e.which || e.keyCode;
		if (key == 17) // Ctrl
		{
			var _this = this;
			this._bCtrlPressed = true;
			setTimeout(function(){_this._bCtrlPressed = false;}, 400);
		}
		else if (key == 16) // Shift
		{
			var _this = this;
			this._bShiftPressed = true;
			setTimeout(function(){_this._bShiftPressed = false;}, 400);
		}
		else if ((this._bShiftPressed || e.shiftKey)  && (e.ctrlKey || this._bCtrlPressed))
		{
			if (key == 83 && this.Params.access == 'W')  // CTRL + SHIFT + S
			{
				this.AddSticker();
				return BX.PreventDefault(e);
			}
			else if(key == 88) // CTRL + SHIFT + X
			{
				this.ShowAll();
				return BX.PreventDefault(e);
			}
			else if(key == 76) // CTRL + SHIFT + L
			{
				this.ShowList('current');
				return BX.PreventDefault(e);
			}
		}
	},

	UpdateStickersCount: function()
	{
		if (this.curPageCount < 0 || isNaN(parseInt(this.curPageCount)))
			this.curPageCount = 0;

		var pEl = BX.findChild(BX('bxst-show-sticker-icon'), {tagName: 'B'}, true);
		if (pEl)
			pEl.innerHTML = "(" + this.curPageCount + ")";
	}
};

function BXStickerList(BXSticker)
{
	this.BXSticker = BXSticker;
	this.access = this.BXSticker.access;
	this.MESS = this.BXSticker.MESS;
	this.arCurPageIds = {};
}

BXStickerList.prototype = {
	Show: function(type)
	{
		if (this.bShowed)
			return;

		var Config = {
			content_url: '/bitrix/admin/fileman_stickers.php?sticker_action=show_list&' + this.BXSticker.sessid_get + '&cur_page=' + this.BXSticker.Params.pageUrl + '&type=' + type + '&site_id=' + this.BXSticker.Params.site_id,
			title : this.MESS.StickerListTitle,
			width: this.BXSticker.Params.listWidth,
			height: this.BXSticker.Params.listHeight,
			min_width: 800,
			min_height: 400,
			resizable: true,
			resize_id: 'bx_sticker_list_resize_id'
		};

		this.type = type;
		this.bRefreshPage = false;
		this.naviSize = this.BXSticker.Params.listNaviSize;
		this.oDialog = new BX.CDialog(Config);
		this.oDialog.Show();
		this.oDialog.SetButtons([this.oDialog.btnClose]);
		this.bShowed = true;

		var _this = this;
		BX.addCustomEvent(this.oDialog, 'onWindowUnRegister', function()
		{
			_this.bShowed = false;
			if (_this.bRefreshPage)
				window.location = window.location;
		});
		//BX.addCustomEvent(this.oDialog, 'onWindowResize', function(){_this.AdjustToSize();});

		// Adjust Navi size
		BX.addCustomEvent(this.oDialog, 'onWindowResizeFinished', function(){_this.AdjustNaviSize();});
		BX.addCustomEvent(this.oDialog, 'onWindowExpand', function(){_this.AdjustNaviSize();});
		BX.addCustomEvent(this.oDialog, 'onWindowNarrow', function(){_this.AdjustNaviSize();});
	},

	OnLoad: function(count)
	{
		this.pAllBut = BX('bxstl_fil_all_but');
		this.pMyBut = BX('bxstl_fil_my_but');
		this.pColorCont = BX('bxstl_col_cont');
		this.pOpenedBut = BX('bxstl_fil_opened_but');
		this.pClosedBut = BX('bxstl_fil_closed_but');
		this.pAllStickersBut = BX('bxstl_fil_all_p_but');

		this.pItemsTable = BX('bxstl_items_table');
		this.pItemsTableCnt = BX('bxstl_items_table_cnt');
		this.pNaviCont = BX('bxstl_navi_cont');

		if (this.access == 'W')
		{
			this.pActionSel = BX('bxstl_action_sel');
			this.pActionBut = BX('bxstl_action_ok');
		}

		this.pPageSelect = BX('bxstl_fil_page_sel');

		if (this.type == 'current')
		{
			this.BXSticker.Params.filterParams.status = 'all';
			this.BXSticker.Params.filterParams.page = 'current';
		}
		else if (this.type == 'all')
		{
			this.BXSticker.Params.filterParams.status = 'opened';
			this.BXSticker.Params.filterParams.page = 'all';
		}

		var _this = this;
		var _col = this.BXSticker.Params.filterParams.colors;
		if (_col && _col != 'all' && _col.length > 0)
		{
			this.checkedColors = [false, false, false, false, false, false];
			for (var i = 0, l = _col.length; i < l; i++)
				if (_col[i] != 99)
					this.checkedColors[parseInt(_col[i])] = true;
		}
		else
		{
			this.checkedColors = [true, true, true, true, true, true];
		}

		if (!this.bRefreshPage && window.__bxst_result.cur_page_ids !== false && typeof window.__bxst_result.cur_page_ids == 'object')
		{
			for (var i in window.__bxst_result.cur_page_ids)
				this.arCurPageIds[parseInt(window.__bxst_result.cur_page_ids[i])] = true;
		}

		/* Colors filter*/
		var i, l = this.BXSticker.colorSchemes.length, col, pCol, __s = (BX.browser.IsIE() && !BX.browser.IsDoctype()) ? 'style="width: 12px; height: 12px"' : '';
		for (i = 0; i < l; i++)
		{
			col = this.BXSticker.colorSchemes[i];
			pCol = this.pColorCont.appendChild(BX.create("DIV", {props: {id: 'bxstl_color_' + i, className: 'bxstl-color-pick' + (this.checkedColors[i] ? ' bxstl-color-pick-ch' : ''), title: col.title}, html: '<div class="bxstl-col-pic-l"></div><div class="bxstl-col-pic-c"><div class="' + col.name + '" ' + __s + '>&nbsp;</div></div><div class="bxstl-col-pic-r"></div>'}));
			pCol.onclick = function()
			{
				var colorInd = parseInt(this.id.substr('bxstl_color_'.length));
				_this.checkedColors[colorInd] = !_this.checkedColors[colorInd];
				if (_this.checkedColors[colorInd])
					BX.addClass(this, 'bxstl-color-pick-ch');
				else
					BX.removeClass(this, 'bxstl-color-pick-ch');

				_this.ReloadList();
			};
		}

		/* Stickers type: my | all*/
		this.SetStickerType(this.BXSticker.Params.filterParams.type, false);
		this.pAllBut.onclick = function(){_this.SetStickerType('all')};
		this.pMyBut.onclick = function(){_this.SetStickerType('my')};

		/* Stickers status: opened | closed | all*/
		this.SetStickerStatus(this.BXSticker.Params.filterParams.status, false);
		this.pOpenedBut.onclick = function(){_this.SetStickerStatus('opened');};
		this.pClosedBut.onclick = function(){_this.SetStickerStatus('closed');};
		this.pAllStickersBut.onclick = function(){_this.SetStickerStatus('all');};

		if (this.access == 'W')
			this.pActionBut.onclick = function(){_this.Action();};
		this.pPageSelect.onchange = function(){_this.SetPage(this.value);};

		this.SetPage(this.BXSticker.Params.filterParams.page == 'current' ? this.BXSticker.Params.pageUrl : this.BXSticker.Params.filterParams.page, false);

		count = parseInt(count);
		this.oDialog.SetTitle(this.MESS.StickerListTitle + " (" + count + ")");

		this.EnableActionBut(false);
		//this.AdjustToSize();
	},

	SetStickerStatus: function(status, bReload)
	{
		if (status == 'opened')
		{
			BX.addClass(this.pOpenedBut, 'bxstl-but-checked');
			BX.removeClass(this.pClosedBut, 'bxstl-but-checked');
			BX.removeClass(this.pAllStickersBut, 'bxstl-but-checked');
		}
		else if (status == 'closed')
		{
			BX.removeClass(this.pOpenedBut, 'bxstl-but-checked');
			BX.addClass(this.pClosedBut, 'bxstl-but-checked');
			BX.removeClass(this.pAllStickersBut, 'bxstl-but-checked');
		}
		else
		{
			BX.removeClass(this.pOpenedBut, 'bxstl-but-checked');
			BX.removeClass(this.pClosedBut, 'bxstl-but-checked');
			BX.addClass(this.pAllStickersBut, 'bxstl-but-checked');
		}

		this.StickersStatus = status;
		if (bReload !== false)
			this.ReloadList();
	},

	SetStickerType: function(type, bReload)
	{
		if (type == 'all')
		{
			BX.addClass(this.pAllBut, 'bxstl-but-checked');
			BX.removeClass(this.pMyBut, 'bxstl-but-checked');
		}
		else
		{
			BX.addClass(this.pMyBut, 'bxstl-but-checked');
			BX.removeClass(this.pAllBut, 'bxstl-but-checked');
		}

		this.StickersType = type;
		if (bReload !== false)
			this.ReloadList();
	},

	SetPage: function(value, bReload)
	{
		this.pPageSelect.value = value;
		this.StickersPage = value;

		if (bReload !== false)
			this.ReloadList();
	},

	NaviGet: function(page, navNum)
	{
		var params = {};
		params['PAGEN_' + navNum] = page;
		this.ReloadList(params)
	},

	ReloadList: function(params)
	{
		var _this = this;
		if (!params)
			params = {};

		params.sticker_just_res = 'Y';
		params.colors = [99];
		params.sticker_type = this.StickersType;
		params.sticker_status = this.StickersStatus;
		params.sticker_page = this.StickersPage;
		params.navi_size = this.naviSize;
		params.cur_page = this.BXSticker.Params.pageUrl;
		params.type = this.type;

		// Fetch filter color params
		var i, l = this.checkedColors.length;
		for (i = 0; i < l; i++)
			if (this.checkedColors[i] === true)
				params.colors.push(i);

		window.__bxst_result.list_rows_count = false;
		window.__bxst_result.cur_page_ids = false;
		this.BXSticker.Request('show_list', params,
			function(result)
			{
				var arRes = result.split('#BX_STICKER_SPLITER#');
				if (arRes.length == 2)
				{
					_this.pItemsTableCnt.innerHTML = arRes[0];
					_this.pNaviCont.innerHTML = arRes[1];
				}

				// Display count of selected rows in title
				if (window.__bxst_result.list_rows_count !== false)
					_this.oDialog.SetTitle(_this.MESS.StickerListTitle + " (" + parseInt(window.__bxst_result.list_rows_count) + ")");

				if (!_this.bRefreshPage && window.__bxst_result.cur_page_ids !== false && typeof window.__bxst_result.cur_page_ids == 'object')
				{
					for (var i in window.__bxst_result.cur_page_ids)
						_this.arCurPageIds[parseInt(window.__bxst_result.cur_page_ids[i])] = true;
				}

				_this.pItemsTable = BX('bxstl_items_table');
				_this.EnableActionBut(false);
			}, true
		);
	},

	AdjustToSize: function(w, h)
	{
		return;
		// if (typeof w == 'undefined' || typeof h == 'undefined')
		// {
			// w = parseInt(this.oDialog.GetContent().style.width);
			// h = parseInt(this.oDialog.GetContent().style.height);
		// }

		// var
			// idW = 25, // ID
			// dateW = 150, // Date
			// colorW = 52, // Color
			// authorW = 120, // Author
			// actionW = 30, // Author
			// textW = titleW = Math.round((w - 20 - idW - dateW - colorW - authorW - actionW) / 2);

		// var tr = this.pItemsTable.rows[0];
		// tr.cells[0].style.width = idW + 'px';
		// tr.cells[1].style.width = titleW + 'px'
		// tr.cells[2].style.width = dateW + 'px';
		// tr.cells[3].style.width = textW + 'px';
		// tr.cells[4].style.width = colorW + 'px';
		// tr.cells[5].style.width = authorW + 'px';
		// tr.cells[6].style.width = actionW + 'px';

		//this.pItemsTableCnt.style.height = (h - 80 /* header */ - 80 /* footer */) + "px";
	},

	AdjustNaviSize: function()
	{
		var
			newNaviSize,
			h = parseInt(this.oDialog.GetContent().style.height),
			rowHeight = 40,
			maxHeight = (h - 100 /* header */ - 80 /* footer */);

		if (maxHeight != (rowHeight * this.naviSize))
			newNaviSize = Math.floor(maxHeight / rowHeight);

		if (newNaviSize < 5)
			newNaviSize = 5;
		if (newNaviSize > 30)
			newNaviSize = 30;

		if (this.naviSize != newNaviSize)
		{
			this.naviSize = newNaviSize;
			this.ReloadList();
		}
	},

	CheckAll: function(checked)
	{
		var i, l = this.pItemsTable.rows.length, bFind = false;
		for (i = 1; i < l; i++)
		{
			if (this.pItemsTable.rows[i].cells.length == 7)
			{
				this.pItemsTable.rows[i].cells[6].firstChild.checked = !!checked;
				bFind = true;
			}
		}

		if (bFind)
			this.EnableActionBut(checked);
	},

	Action: function()
	{
		if (this.access != 'W')
			return;

		var action = this.pActionSel.value;
		if (action == '' || (action == 'del' && !confirm(this.MESS.DelConfirm)))
			return;

		var i, l = this.pItemsTable.rows.length, arIds = [];
		for (i = 1; i < l; i++)
		{
			if (this.pItemsTable.rows[i].cells.length < 7)
				continue;
			ch = this.pItemsTable.rows[i].cells[6].firstChild;
			if (ch.checked)
			{
				arIds.push(ch.value);
				if (!this.bRefreshPage && this.arCurPageIds[parseInt(ch.value)])
					this.bRefreshPage = true;
			}
		}
		this.ReloadList({list_action: action, list_ids: arIds});
	},

	EnableActionBut: function(bEnable)
	{
		if (this.access != 'W')
			return;

		if (bEnable == 'check')
		{
			var i, l = this.pItemsTable.rows.length, bEnable = false;
			for (i = 1; i < l; i++)
			{
				if (this.pItemsTable.rows[i].cells.length < 7)
					continue;
				if (this.pItemsTable.rows[i].cells[6].firstChild.checked)
				{
					bEnable = true;
					break;
				}
			}
		}
		this.pActionBut.disabled = !bEnable;
		this.pActionSel.disabled = !bEnable;
	}
};

/* End */
;; /* /bitrix/templates/shik/script.js*/
; /* /bitrix/components/bitrix/sale.basket.basket.line/templates/.default/script.js*/
; /* /bitrix/components/bitrix/search.title/script.js*/
; /* /bitrix/templates/shik/components/bitrix/menu/site_top_menu/script.js*/
; /* /bitrix/components/bitrix/catalog.viewed.products/templates/.default/script.js*/
; /* /bitrix/js/fileman/sticker.js*/
