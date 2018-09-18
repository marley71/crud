#App

App è la classe per la gestione della pagina. 

##Proprietà

####_confs = null;

    var _resources = {};        // vettore di risorse registrate al caricamento della pagina
    var _resources_loaded = {}; // vettore di risorse gia' caricate
    var _coreActions = [        // vettore azioni core
        "actionEdit","actionView","actionDelete",
        "actionInsert","actionMultiDelete",
        "actionFirstPage","actionNextPage","actionPrevPage","actionLastPage",
        "actionPerPage","actionSearch","actionReset",
        "actionBack","actionCancel",
    ];
    var _supportedViewTypes = ['list', 'search', 'edit', 'view', 'calendar', 'csv'];
    var _viewCounter = 0; // counter per la generazione automatica id view
    var _views = {};
    var _viewsId = {};
    var _defaultConfs = {
            'list': ListConfs,
            'edit': EditConfs,
            'search': SearchConfs,
            'calendar': CalendarConfs,
            //'csv': CsvConfs
    };


    App.resources = [];     // vettore di risorse iniziali da caricare
    App.pluginsPath = '/cupparis4/plugins/';


##Metodi

####getConf = function ()  //ritorna la classe per il caricamento delle confs
####getResources = function () {
        return _resources;
    }
###init = function(options,callback) {
        var self = this;
        var _o = options?options:{};

        var logActive = _o.log || _o.logMobile;
        window.log = new Log(logActive,_o.logMobile);

        for(var k in _o) {
            self[k] = _o[k];
        }
        _confs = new Confs();

        EventManager.on("loadResource",function (event) {
            event.preventDefault();
            log.info('on loadResource fired',event.params.resource);
            self.loadResource(event.params.resource,event.callback);
        })
        EventManager.on("loadResources",function (event) {
            event.preventDefault();
            log.info('on loadResources fired',event.params.resources);
            self.loadResources(event.params.resources,event.callback);
        })
        // EventManager.on('actionSwap',function (event) {
        //     _callCoreAction('actionSwap',event.params);
        // })
        
        App.loadResources(App.resources,callback);
    }

####loadResource = function (fileName, callback) {
        var self = this;
        var _callback = callback?callback:function () {};
        var re = /(?:\.([^.]+))?$/;
        var ext = re.exec(fileName)[1];
        if (ext == 'js') {
            _loadScript(self.pluginsPath+fileName,_callback);
        } else if (ext == 'css') {
            _loadCss(self.pluginsPath+fileName,_callback);
        } else {
            throw 'invalid extension ' + ext;
        }
    }

####loadResources = function(resources, callback) {
        var self = this;
        var _callback = callback?callback:function () {};
        var _callback = callback?callback:function () {};
        if (!resources || resources.length == 0)
            return _callback();
        var _recursive = function (i,callback) {
            self.loadResource(resources[i],function () {
                //log.info('_recursive', resources[i]);
                if (i < resources.length-1)
                    _recursive(i+1,_callback);
                else {
                    _callback();
                }
            })
        }
        _recursive(0,function () {
            _callback();
        })
    }


    /**
     * aggiunge una view al controller
     * viewClass : tipo di view, se e' di quelle standard, non serve il type
     * params :  vettore associativo opzionale
     {
         model : nome modello dati
 *       config : configurazione view
 *       data : dati della lista,
         container: container
     }
     */
####addView = function (options) {
        var self = this;
        log.debug('App.addView', options);
        if (!options.modelName)
            throw 'Invalid model Name';
        if (!window[options.viewClass])
            throw 'View Class name ' + options.viewClass + ' not definited!';
        //console.log(options);
        var view = new window[options.viewClass](options);
        if (!view.type || jQuery.inArray(view.type, _supportedViewTypes) < 0)
            throw 'view type ' + view.type + ' not supported';

        // view.pk =params.pk;
        // if (params.config)
        //     view.setConfig(params.config);
        // else {
        //     view.setConfig(new _defaultConfs[view.type]());
        // }
        view.setApp(self);

        //view.config = params.config?params.config: new self._defaultConfs[view.type]();
        var viewKey = 'v' + _viewCounter;
        view.setId(viewKey);
        view.setActionListener();
        log.debug("constraint ", options.constraint);
        _views[viewKey] = view;
        if (options['id'])
            _viewsId[options['id']] = viewKey;
        log.debug('addView ' + viewKey, _views[viewKey]);
        _viewCounter++;
        if (options.autorender)
            self.renderView(viewKey);
        return viewKey;
    };

####removeView = function (key) {
        var self = this;
        try {
            if (!_views[key])
                return;
            delete _views[key];
        } catch (e) {
            log.error(e);
        }
    };

####removeAllViews = function () {
        var self = this;
        for (var k in _views) {
            self.removeView(k);
        }
        delete _views;
        _views = {};
    };

####connectView = function (key, connectionView) {
        var self = this;
        var action = connectionView.action;
        if (!_views[key]['connected_view'][action])
            _views[key]['connected_view'][action] = [];
        _views[key]['connected_view'][action].push(connectionView);
    };

####renderViews = function () {
        var self = this;
        for (var key in _views) {
            self.renderView(key);
        }
    };

####renderView = function (key, callback) {
        _views[key].render(function () {
            if (callback) callback();
        })
    };

####getView = function (key) {
        return _views[key];
    };

####getKeyFromId = function (htmlId) {
        return _viewsId[htmlId];
    };

####removeViewById = function (htmlId) {
        return this.removeView(this.getKeyFromId(htmlId));
    };

####removeView = function(key) {
        // constrollo che non esiste la key negli id html, altrimenti rimuovo anche da li'.
        for (var k in _viewsId) {
            if (key == _viewsId[k]) {
                delete _viewsId[k];
                break;
            }
        }
        var v = _views[key];
        delete v;
        delete _views[key];
        //this.controller.removeView(key);
    };

####renderViewById = function (htmlId,callback) {
        this.renderView(this.getKeyFromId(htmlId),callback);
    };

####getViewById = function(htmlId) {
        return this.getView(this.getKeyFromId(htmlId));
    }

####getHtmlConf = function (jQe) {
        var type = jQe.attr('data-view');
        //var viewClass = jQe.attr('view_class')?jQe.attr('view_class'):Utility.pascalCase('view_'+ type);

        //var params = jQe.attr();
        var params = {};
        $.each(jQe[0].attributes, function() {
            if(this.specified) {
                params[Utility.camelCase(this.name)] = this.value;
            }
        });
        if (Utility.lowerCase(params.autorender)  === 'false') {
            params.autorender = false;
        } else {
            params.autorender = true;
        }




        var config = null;

        if (params.conf) {
            config = new window[params.conf]();
        } else {
            config = _confs.getConf(params.modelName,type,params.role);
        }
        config.container = jQe;
        for (var k in params) {
            config[k] = params[k];
        }
        // se non c'e' definita prendo come view la classe di default in base al tipo
        if (!config.viewClass) {
            config.viewClass = Utility.pascalCase('view_' + type);
        }
        log.debug('Created view options ',config);
        return config;
    }

####parse = function (container) {
        var self = this;
        var realContainer = container?container:'body';
        log.debug("App.parse " + realContainer,jQuery(realContainer).length);
        var new_keys = [];
        var founds = [];

        jQuery.each(jQuery(realContainer).find('[data-view]'),function () {
            var htmlConf = self.getHtmlConf(jQuery(this));
            console.log('CONF',htmlConf);


            var vkey = self.addView(htmlConf);


            founds.push(jQuery(this).data('view') + " " + jQuery(this).attr('model_name'));
            // new_keys.push(key);
            // //jQuery(this).attr('vkey',key);
            // self.viewContainers[key] = jQuery(this);
            // if (jQuery(this).attr('id'))
            //     self.viewIds[jQuery(this).attr('id')] = key;
        });
        log.debug('founds ',founds);
        //self.renderViews();
        // connetto solo le view nuove che sono state inserite
        //self.connectActions(new_keys);
    };


####createModal = function (title,viewConfs,callback) { //(model,type,title,attrs,callback) {
        var self = this;
        viewConfs.autorender = true;
        viewConfs.container = '#generalDialog .modal-body';
        var vkey = app.addView(viewConfs);

        jQuery.generalDialog(null,{title: title, hide_buttons: true});
        jQuery('#generalDialog').on('hidden.bs.modal', function () {
            app.removeView(vkey);
            if (callback)
                callback();
        })
        return vkey;
    };

###dashboardModal = function (dashConfs,callback) {
        var self = this;

        var dash = new window[ Utility.pascalCase(dashConfs.className)]( dashConfs.model);
        dashConfs.conf.container = '#generalDialog .modal-body';
        dash.create(dashConfs.conf);

        jQuery.generalDialog(null,{title: dashConfs.title, hide_buttons: true});
        jQuery('#generalDialog').on('hidden.bs.modal', function () {

            if (callback)
                callback();
        })
    }




