#Actions


##CoreAction
Classe principale delle azioni. Le azioni rappresentano l'aggancio per le interazioni con 
l'utente sulle views, dashboard oppure semplici bottoni html. Da questa classe
sono state definite altri due azioni generali la RecordAction e la CollectionAction che
fondamentalmente dividono il comportamento in azioni che agiscono sul singolo record
e azioni che agiscono su una collezione di record.

###Proprietà

- `container` : default null
- `htmlEvent` : default 'onclick'      evento html associato che fa scattare l'azione
- `type` : default null può essere record o collection
- `controlType` : default 'button',
- `text` : '',
- `icon` : '',
- `cssClass` : '',
- `target` : '',
- `href` : '',
- `params` : [],
- `enabled` : true,
- `visible` : true,
- `title` : '',
- `_htmlProperties` : ['text','icon','cssClass','target','href','params','title','enabled','visible','onclick','onchange'],


###Metodi

- init : function (params) 
costruttore. Il parametro *params* rappresenta i parametri da sovrascrivere

    func : function () {
        throw "func must be overloaded!";
    },

    getTemplate : function (templateString) {
        var self = this;
        var tpl = templateString?templateString:self["_"+self.controlType+"Template"]();
        var div = document.createElement("div");
        jQuery(div).html(jQuery.parseHTML(tpl));
        return jQuery(div);
    },

    render : function () {
        var self = this;
        var tpl = self.getTemplate();
        var data = self._getData();

        jQuery.renderTemplate(tpl,self.container,data);
    },

    html : function () {
        var self = this;
        var tpl = self.getTemplate();
        var data = self._getData();
        return jQuery.getTemplate(tpl,data);
    },
    _getData : function () {
        var self = this;
        var data = {};
        for (var i in self._htmlProperties) {
            var key = self._htmlProperties[i];
            if (_.isFunction(self[key])) {
                data[key] = self[key]();
            } else {
                data[key] = self[key];
            }
        }
        if (self.controlType == 'link') {
            data[self.htmlEvent] = null;
            data['href'] = self.func();
        }
        return data;
    },
    callback : function (json) {

    }
    
##RecordAction

###Proprietà

type : 'record',
    cssClass : 'btn btn-default btn-xs btn-group',
    _buttonTemplate : function () {
        var special_attrs = `"{'` + this.htmlEvent + `':` + this.htmlEvent + `,'title':title,'data-params':params}"`;
        return `
                <button  type="button" data-visible=visible data-class="cssClass"  data-attrs=`+ special_attrs + ` data-addclass="enabled?'':'disabled'">
                    <i data-remove="!icon" data-class="icon"></i>
                    <span data-field="text"></span>
                </button>    
            `;
    },
    _linkTemplate : function () {
        return `
                <a data-href="href" data-visible="visible" data-class="cssClass"  data-attrs="{'title':title,'data-params':params,'target':target}" target="_blank" data-addclass="enabled?'':'disabled'">
                    <i data-remove="!icon" data-class="icon"></i>
                    <span data-field="text"></span>
                </a>   
            `
    }


##CollectionAction


###Proprietà

type : 'collection',
    _buttonTemplate : function () {
        var special_attrs = `"{'` + this.htmlEvent + `':` + this.htmlEvent + `,'title':title,'data-params':params}"`;
        return `
                <button  type="button" data-visible=visible data-class="cssClass"  data-attrs=`+ special_attrs + ` data-addclass="enabled?'':'disabled'">
                    <i data-remove="!icon" data-class="icon"></i>
                    <span data-field="text"></span>
                </button>    
            `;
    },
    _linkTemplate : function () {
        return `
                <a data-href="href" data-visible="visible" data-class="cssClass"  data-attrs="{'title':title,'data-params':params,'target':target}" target="_blank" data-addclass="enabled?'':'disabled'">
                    <i data-remove="!icon" data-class="icon"></i>
                    <span data-field="text"></span>
                </a>   
            `;
    }
    
    

Sono state definite le azioni generali per le view presenti nella libreria.

    
ci sono 4 azioni principali già implementate

- delete
- deleteSelected
- insert
- save
- view


var actionEdit = RecordAction.extend({
    title : 'Modifica',
    icon : 'fa fa-edit',
    func : function () {
        var self = this;
        var constraintSuffix = '';
        if (self.view.constraint) {
            constraintSuffix = '/' + self.view.constraintKey + '/' + self.view.constraintValue;
        }
        document.location.href=Server.getUrl('/edit/' + self.view.modelName + '/' + self.modelData.id + constraintSuffix);
    }
})


var actionInsert = CollectionAction.extend({
    title : 'Inserisci',
    icon : 'fa fa-plus text-success',
    cssClass : 'btn btn-default btn-xs text-success',
    text : 'Nuovo',
    func : function () {
        var self = this;
        var constraintSuffix = '';
        if (self.view.constraintKey && self.view.constraintValue) {
            constraintSuffix = '/' + self.view.constraintKey + '/' + self.view.constraintValue;
        }
        document.location.href=Server.getUrl('/insert/' + self.view.modelName + constraintSuffix);
    }
})

var actionSave = RecordAction.extend({
    title : 'Salva',
    text : 'Salva',
    func : function () {
        var self = this;
        if (!self.view.valid()) {
            log.debug('actionSave form Data view is not valid!');
            return;
        }
        var r = null;
        var rname = null;
        if (self.view.pk) {
            rname = 'update';
        } else {
            rname = 'save';
        }

        if (self.view.constraintKey && self.view.constraintValue)
            rname += '_constraint';

        r = CoreRoute.factory(rname);

        var rkeys = r.getKeys();
        r.values = {};
        for (var i in rkeys)
            r.values[rkeys[i]] = self.view[rkeys[i]];

        r.params = self.view.getFormData();
        jQuery.waitStart();

        Server.route(r,function (json) {
            jQuery.waitEnd();
            self.callback(json)
        })

        // var params = self.view.getFormData();
        // params = jQuery.extend(params,r.extra_params);
        // jQuery.waitStart();
        // r.params = params;
        // Server.route(r,function (json) {
        //     jQuery.waitEnd();
        //     self.callback(json)
        // })
    },
    callback : function (json) {
        if (json.error) {
            jQuery.errorDialog(json.msg);
            return;
        }
        app.renderView(this.view.keyId);
    }
})

var actionBack = RecordAction.extend({
    title : 'Indietro',
    text : 'Torna indietro',
    func : function () {
        window.history.back();
    }
})

var actionView = RecordAction.extend({
    title :'Visualizza',
    icon:  'fa fa-list-alt',
    func : function () {
        var self = this;
        var constraintSuffix = '';
        if (self.view.constraint) {
            constraintSuffix = '/' + self.view.constraintKey + '/' + self.view.constraintValue;
        }
        document.location.href=Server.getUrl('/view/' + self.view.modelName + '/' + self.modelData.id + constraintSuffix);
    }
})

var actionDelete = RecordAction.extend({
    title : 'Cancella',
    icon:  'fa fa-remove text-danger',
    func : function () {
        var self = this;
        var view = self.view;
        jQuery.confirmDialog('Sei sicuro di voler cancellare l\'elemento?').ok(function () {
            var r = CoreRoute.factory('delete');
            r.values = {
                modelName: self.view.modelName,
                pk : self.modelData.id
            };
            jQuery.waitStart();
            //var params = r.extra_params;
            //r.params = r.extra_params;
            Server.route(r,function (json) {
                jQuery.waitEnd();
                self.callback(json);
            })
        });
    },
    callback : function (json) {
        if (json.error) {
            jQuery.errorDialog(json.msg);
            return;
        }
        app.renderView(this.view.keyId);
    }
})


var actionMultiDelete = CollectionAction.extend({
    title : 'Cancella selezionati',
    icon:  'fa fa-trash text-danger',
    cssClass : 'btn btn-default btn-xs text-danger',
    text : 'Selezionati',
    needSelection : true,
    func : function () {
        var self = this;
        var checked = self.view.getChecked();
        var num = checked.length;
        if (num === 0)
            return ;
        jQuery.confirmDialog('Sei sicuro di voler cancellare (' + num + ') elementi selezionati?').ok(function () {
            var r = CoreRoute.factory('multi_delete');
            r.values = {
                modelName: self.view.modelName
            };
            jQuery.waitStart();
            r.params = {'ids': checked};
            //console.log('MULTIDELETE',checked);
            Server.route(r,function (json) {
                jQuery.waitEnd();
                self.callback(json);
            })
        });
    },
    callback : function (json) {
        if (json.error) {
            jQuery.errorDialog(json.msg);
            return;
        }
        app.renderView(this.view.keyId);
    }
});

var actionSearch = CollectionAction.extend({
    title : 'Ricerca',
    icon:  'fa fa-search',
    cssClass : 'btn btn-xs btn-default text-info',
    text : 'Cerca',
    func : function () {
        var self = this;
        var view = self.view;
        var params = view.getParams();
        params.page = 1;
        window.location.href = window.location.origin + Server.getUrl(window.location.pathname + '?' + jQuery.param(params));
        return ;
    }
});


var actionReset =  CollectionAction.extend({
    title : 'Annulla filtri ricerca',
    cssClass : 'btn btn-xs btn-default',
    text : 'Annulla filtri',
    func : function () {
        console.log(this);
        this.view.resetForm();
        this.callback();
        //var params = {viewKey:viewKey}
        //EventManager.trigger(this.action,params);
    }
});


var actionNextPage = CollectionAction.extend({
    icon : 'fa fa-angle-right',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page < this.view.data.pagination.last_page) {
            r.params['page'] = this.view.data.pagination.current_page +1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }
    }
});

var actionPrevPage = CollectionAction.extend({
    icon : 'fa fa-angle-left',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page > 1) {
            r.params['page'] = this.view.data.pagination.current_page - 1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});


var actionFirstPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-left',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page > 1) {
            r.params['page'] = 1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});

var actionLastPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-right',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page < this.view.data.pagination.last_page) {
            r.params['page'] = this.view.data.pagination.last_page;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});

var actionPerPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-right',
    htmlEvent : 'onchange',
    cssClass : 'btn btn-default btn-xs',
    init : function (params) {
        this._super(params);
        this._htmlProperties.push('pagination');
    },
    func : function () {
        var self = this;
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        //console.log('html',self.container,jQuery(self.container).html());
        r.params['page'] = 1;
        r.params['paginateNumber'] = jQuery(self.container).find('select').val();
        this.view.setRoute(r);
        app.renderView(this.view.keyId);
        this.callback();

    },
    _getData : function () {
        var data = this._super();
        data.pagination.pagination_order = _.sortBy(_.keys(data.pagination.pagination_steps), function (num) {
            return parseInt(num);
        });
        return data;
    },
    _buttonTemplate : function () {
        var special_attrs = `"{'` + this.htmlEvent + `':` + this.htmlEvent + `,'title':title,'data-params':params}"`;
        return `
                <select data-field="pagination.per_page" data-source="pagination.pagination_steps" 
                        data-sourceorder="pagination.pagination_order"
                        data-attrs=`+ special_attrs + `  class="pagination-input">
        
                </select>  
            `
    },
});

#Azioni implementate
La libreria mette a disposizione già delle azioni di uso comune


