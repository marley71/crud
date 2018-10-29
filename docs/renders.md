#Render

La classe `Render` rappresenta la classe per la gestione di un singolo dato. La classe render
può essere utilizzata in maniera singola, ma il loro utilizzo reale è come componenti dei singoli
dati di una view. Dentro la view un render può essere usato n 3 modi differenti, in modalità edit, search,
view. La visualizzazione dell'oggetto render avviene con il metodo draw().

La classe Render definisce alcuni metodi di uso generale e i metodi che i veri oggetti Render
devono ridefinire per funzionare. Dobbiamo considerarla come la classe astratta che definisce l'interfaccia
da definire nei vari oggetti Render concreti.

il modo è definito nelle costanti
```javascript
Render.VIEW = 'view';
Render.EDIT = 'edit';
Render.SEARCH = 'search';
```

##Proprietà

- key : null,                 // nome dell'oggetto render (il campo del db)
- type : null,                // type dell'oggetto per gestire le Gerarchie di classi
- className : 'Render',       // nome della Classe reale dell'oggetto
- element_selector : '[data-render_element]',
- control_selector : '[data-render_control]',
- caption_selector : '[data-render_caption]',
- operator_selector : '[data-control_operator]',
- operator : null,

- value : null,           // valore oggetto
- app : null,
- resources : [],         // vettore risorse da caricare prima di chiamare il finalize
- metadata : {},       // array associativo metadati che descrivono il dato


##Metodi

- init : function (key,attributes) 
- _setHtmlAttributes : function(el)
- change : function ()
- clear : function ()
- setMetadata : function (metadata)


    
#Render Implementati

La libreria mette a disposizione dei renders di default per gli usi più comuni.
Questi possono essere ridefiniti, in caso vogliamo cambiare, nella nostra applicazione,
aspetto o funzionalità. A questi definiti se ne possono aggiungere altri usando
l'erediaretà. I renders vengono istanziati in automatico dalle views, oppure possono
essere istanziati manualmente.

#RenderAutocomplete

Questo render permette il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata nel input nascosto.
Esiste solo in modalità edit che si chiama `RenderAutocompleteEdit`

il suo template di default:
```html
<div class="input-group">
    <span style="height:19px" class="input-group-addon" id="basic-addon1" data-render_autocomplete_view data-lang="autocomplete-nonselezionato"></span>
    <input data-render_control type="hidden" name="" value="">
    <div data-render_element class="autosuggest" data-minLength="1" data-queryURL="">
        <input data-render_autocomplete_input type="text" name="src" placeholder="" class="form-control typeahead" />
    </div>
</div>
```


##Proprietà

- `autocomplete_view_selector` : '[data-render_autocomplete_view]',
- `autocomplete_input_selector` : '[data-render_autocomplete_input]',

- `fields` : [],                // campi da visualizzare dopo la selezione
- metadata : {
        modelData : null,           // dati del modello selezionato
        autocompleteModel : null,   // nome modello da utilizzare nelle chiamate rest per la popolazione dei dati
        method : null,              // eventuale parametro da mandare in get nella chiamata rest
        separator : null,           // separatore da utillare nella visualizzazione dei campi in caso siano piu' di uno
        n_items : null,             // numero di items da richiedere
        model_description : []
    },
- resources : vettore delle risorse esterne che ha bisogno per funzionare. Questo render si appoggia a
typeahead bootstrap.

```javascript
resources : [
        'typeahead/bootstrap3-typeahead.min.js',
        'typeahead/typeahead.bundle.js',
        'typeahead/typeaheadjs.css'
]
```


##Metodi

- `_getLabelValue` : function ()
    /**
     * ritorna il nome dell'inputview, tiene conto del fatto che si potrebbe trovare in un hasmany
     * e il nome potrebbe avere le []
     */

- `_getInputViewName` : function () 

- `_getFieldValue` : function() 

- `_createUrl` : function () 

- `_renderSelectedValue` : function () 

- `getAutocompleteRow` : function (element) 

- `ev_selected` : function (datum) 

- `getValue` : function () 






# RenderBelongsto.js

Questo render è solo per la visualizzazione di dati più complessi che non sono formati da un solo
valore, in genere viene utilizzato per la rappresentazione di campi di una tabella
esterna rispetto a campo corrente, istanza

var RenderBelongsto =  Render.extend({
    itemViewTemplate : null,
    separator : null,
    fields: {},
    nullLabel : '',


    getValue : function () {
        var self = this;
        return self.value;
    },

});

var RenderBelongstoView = RenderBelongsto.extend({
    render : function(callback) {
        var self = this;

        if (!self.value) {
            jQuery(self.container).find('[data-render_element]').html(self.nullLabel);
            return ;
        }

        if (self.itemTemplate()) {
            var tpl = Component.parseHtml(self.itemTemplate());
            var html = jQuery.getTemplate(tpl,self.value);
            jQuery(self.container).find('[data-render_element]').html(html);
            return ;
        }

        var separator = self.separator?self.separator:" ";
        var label = "";
        for (var fi in self.fields) {
            var field = self.fields[fi];
            label+= self.value[field];
            if (fi < self.fields.length-1)
                label+= separator;
        }

        jQuery(self.container).find('[data-render_element]').html(label);
        return callback();

    },

    template : function () {
        return `<div data-render_element></div>`
    },

    itemTemplate : function () {
        return false;
    }
})


# RenderDateSelect.js

Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza le selectbox html per l'inserimento di una data.

RenderDateSelect = Render.extend({
    year_selector    : '[data-render_year]',
    month_selector    : '[data-render_month]',
    day_selector    : '[data-render_day]',
    picker_selector : '[data-render_picker]',
    h24 : true,
    operator : null,
    time : false,
    dateFormat : 'YYYY-MM-DD',
    timeFormat : 'H:i:s',
    resources :[
        'moment-with-locales.min.js',
    ],



    selectProps : {
        active : ['day','month','year'],    // select active in dateType select
        startYear : (new Date().getFullYear()) -3,
        endYear : (new Date().getFullYear()) +3,
    },

    _setDateControls : function () {
        var self = this;
        var active = self.selectProps.active?self.selectProps.active:[];
        var currentYear = parseInt(new Date().getFullYear());
        var startYear = self.selectProps.startYear;
        var endYear = self.selectProps.endYear;
        var elD = self.jQe().find(self.day_selector);

        //NO VALUE
        var opt = jQuery('<option>').attr({
            value : ''
        });
        opt.html(self.app.translate('app.giorno'));
        elD.append(opt);

        for (var i=1;i<=31;i++) {
            i = Utility.padDate(i, 2)
            var opt = jQuery('<option>').attr({
                value : i
            });
            opt.html(i);
            elD.append(opt);
        }
        if (jQuery.inArray('day',active) < 0) {
            self.jQe().find('[data-render_day_container]').addClass('hide');
            elD.addClass('hide');
        }

        //MONTH
        var elM = self.jQe().find(self.month_selector);
        //NO VALUE
        var opt = jQuery('<option>').attr({
            value : ''
        });
        opt.html(self.app.translate('app.mese'));
        elM.append(opt);

        for (var i=1;i<=12;i++) {
            i = Utility.padDate(i, 2)
            var opt = jQuery('<option>').attr({
                value : i
            });
            opt.html(i);
            elM.append(opt);
        }
        if (jQuery.inArray('month',active) < 0) {
            self.jQe().find('[data-render_month_container]').addClass('hide');
            elD.addClass('hide');
        }

        //YEAR
        var elY = self.jQe().find(self.year_selector);
        //NO VALUE
        var opt = jQuery('<option>').attr({
            value : ''
        });
        opt.html(self.app.translate('app.anno'));
        elY.append(opt);

        for (var i=endYear;i>startYear;i--) {
            var opt = jQuery('<option>').attr({
                value : i
            });
            opt.html(i);
            elY.append(opt);
        }
        if (jQuery.inArray('year',active) < 0) {
            self.jQe().find('[data-render_year_container]').addClass('hide');
            elD.addClass('hide');
        }
    },



    // _dbDateToArray : function (value) {
    //     var self = this;
    //     if (!value)
    //         return ['','',''];
    //     var tmpData = value;
    //     if (tmpData.indexOf(' ') >= 0) {
    //         tmpData = tmpData.split(' ')[0];
    //     }
    //     if (tmpData.indexOf('T') >= 0) {
    //         tmpData = tmpData.split('T')[0];
    //     }
    //
    //     var sdate = tmpData.split("-");
    //     if (sdate[1] && sdate[1].length == 1) {
    //         sdate[1] = "0"+sdate[1];
    //     }
    //     if (sdate[2] && sdate[2].length == 1) {
    //         sdate[2] = "0"+sdate[2];
    //     }
    //     return sdate;
    // },
    _changeDate : function () {

        var self = this;
        var active = self.active?self.active:['day','month','year'];
        var options = '';
        var year =  jQuery(self.container).find(self.year_selector);
        var month = jQuery(self.container).find(self.month_selector);
        var day =  jQuery(self.container).find(self.day_selector);

        var selected = "";

        var maxDay = 28;
        if (month.val() == '04' || month.val() == '06' || month.val() == '09' || month.val() == '11') {
            maxDay = 30;
        } else if (month.val() != '02') {
            maxDay = 31
        } else if (year.val() % 4 == 0 || year.val() % 100 == 0)
            maxDay = 29;


        for (var i = 1; i <= maxDay; i++) {
            var j = Utility.padDate(i,2);
            if (day.val() == j)
                selected = ' selected="selected" ';
            options += '<option value="' + j + '"' + selected + '>' + j + '</option>';
            selected = '';
        }

        var ex_day = day.val();
        day.empty();
        day.append(options);
        if (ex_day <= maxDay)
            day.val(ex_day);

        var finalDate = jQuery(self.container).find(self.control_selector);//jQuery('input[name="'+key+'"]');
        var d = finalDate.val().split(" ");
        var t = ""; // tempo in caso di campo datetime
        if (d.length > 1)
            t = d[1];

        var date = '';

        //FORZARE YEAR, MONTH E DAY VAL SE NON ATTIVI
        var yearVal = jQuery.inArray('year',active) < 0 ? '0000' : year.val();
        var monthVal = jQuery.inArray('month',active) < 0 ? '00' : month.val();
        var dayVal = jQuery.inArray('day',active) < 0 ? '00' : day.val();
        if (yearVal == '' || monthVal == '' || dayVal == '') {
            date = ''//finalDate.val('');
        } else {
            var date =  yearVal + '-' + monthVal + '-' + dayVal;//finalDate.val(yearVal + '-' + monthVal + '-' + dayVal);
        }
        if (t != "")
            date += ' ' + t;
        finalDate.attr('value',date).val(date);
        self.change();
        return;
    },

    setValue : function (value) {
        var self = this;
        if (!value) {
            self.jQe(self.control_selector).val('');
            self.jQe(self.year_selector).val('');
            self.jQe(self.month_selector).val('');
            self.jQe(self.day_selector).val('');
            return
        }
        var d = value;
        if ( !( value instanceof moment) ) {
            d = new moment(value);
        }
        self.jQe(self.control_selector).val(d.format(self.dateFormat));
        self.jQe(self.year_selector).val(d.format('YYYY')).attr('selected','selected');
        self.jQe(self.month_selector).val(d.format('MM')).attr('selected','selected');
        self.jQe(self.day_selector).val(d.format('DD')).attr('selected','selected');
        return;

        // self.jQe(self.control_selector).val(value);
        // var d = self._dbDateToArray(value);
        // self.jQe(self.year_selector).val(d[0]).attr('selected','selected');
        // self.jQe(self.month_selector).val(d[1]).attr('selected','selected');
        // self.jQe(self.day_selector).val(d[2]).attr('selected','selected');
    },
    getValue : function () {
        var self = this;
        return jQuery(self.container).find(self.control_selector).val();
    },

    clear : function () {
        this.setValue('');
    }
});

RenderDateSelectEdit = RenderDateSelect.extend({

    render : function(callback) {
        var self = this;
        var el = self.jQe().find(self.control_selector);
        el.attr("name", self.key).attr('value',self.value);
        self._setDateControls();
        return callback();
    },

    finalize : function(callback) {
        var self = this;
        self.jQe().find(self.year_selector+","+self.month_selector+","+self.day_selector).change(function () {
            self._changeDate();
            var sdate = jQuery(self.year_selector).val() + "-" + jQuery(self.month_selector).val() + "-" + jQuery(self.day_selector).val();
            //self.setValue(sdate);
        });
        self.setValue(self.value);
        return callback();
    },

    template : function () {
        return `
            <div data-render_element  class="input-group">
                <input data-render_control="" type="hidden" />
                <div class="input-group-btn" data-render_day_container>
                    <select class="form-control" data-render_day>
                    
                    </select>
                </div>
                <div class="input-group-btn" data-render_month_container>
                    <select class="form-control" data-render_month>
                    
                    </select>
                </div>
                <div class="input-group-btn" data-render_year_container>
                    <select class="form-control" data-render_year>
                    
                    </select>
                </div>
            </div>
            `
    },
})

RenderDateSelectSearch = RenderDateSelectEdit.extend({
    render : function(callback) {
        var self = this;
        var el = self.jQe().find(self.control_selector);
        el.attr("name", 's_' + self.key + '[]').attr("value", self.value);
        jQuery('<input>').attr({
            type: 'hidden',
            name: 's_' + self.key + "_operator",
            'data-control_operator' : self.key,
            value : self.operator
        }).appendTo(self.jQe());
        self._setDateControls();
        return callback();
    },
})

RenderDateSelectView = RenderDateSelect.extend({
    dateFormat : 'YYYY-MM-DD',
    displayDateFormat : 'DD/MM/YYYY',
    timeFormat : 'HH:mm:ss',
    displayTimeFormat : 'HH:mm:ss',
    invalidDateString : '',
    time : true,
    resources :[
        //'bootstrap-daterangepicker/moment.js',
        'moment-with-locales.min.js'
    ],
    finalize : function (callback) {
        var self = this;
        self.setValue(self.value);
        return callback();
    },
    _toDate : function (value) {
        var self = this;
        var d = moment(value,self.getFormat());
        d.locale(self.app.getLocale());
        if (!d.isValid()) {
            this.app.log.warn("[" + value + "] Data non valida ");
            return null;
        }
        return d;
    },
    getFormat : function() {
        var self = this;
        return self.dateFormat + (self.time?' ' + self.timeFormat:'')
    },

    getDisplayFormat : function() {
        var self = this;
        return self.displayDateFormat + (self.time?' ' + self.displayTimeFormat:'')
    },
    getValue : function () {
        var self = this;
        return self.value;
    },
    setValue : function (value) {
        var self = this;
        var d = self._toDate(value);
        var el = self.jQe().find(self.element_selector);
        if (!d) {
            el.html(self.invalidDateString);
        } else {
            el.html(d.format(self.getDisplayFormat()));
        }
        self.value = value;
    },
    template : function () {
        return `
            <span data-render_element></span>
        `
    }
})


##- RenderDatePicker.js
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker bootstrap per l'inserimento di una data.

```javascript
resources : {
    edit :  [
        'bootstrap-daterangepicker/daterangepicker.css',
        'bootstrap-daterangepicker/moment.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ],
    search : [
        'bootstrap-daterangepicker/daterangepicker.css',
        'bootstrap-daterangepicker/moment.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ],
    view : []
}
```




##- RenderDateFormatted.js
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker nativo del broswer associato al type=date, se supportato.




##- RenderBetweenDate.js

Questo render serve per la gestione di un range di date.

##- RenderCaptcha.js

Questo render incapsula il captca con il suo relativo reload

##- RenderChoice.js




##- RenderCustom.js

Oggetto per chi vuole poter modificare l'html da renderizzare. Qui si può inserire
tutto quello che si vuole utilizzando che chiamate render e finalize.

##- RenderDecimal.js

Oggetto per la gestione dei decimali con parte intera e decimale gestiti separatamente.

##- RenderFaicon.js

##- RenderHasmany.js
Oggetto per la gestione delle relazioni esterne. Permette l'inserimento e visualizzazione
di relazioni esterne in un'unica form.

##- RenderHasmanyThrough.js

Oggetto per la gestione degli hasmany trought...

##- RenderHasmanyUpload.js

Oggetto per la gestione di hasmany che prevedo un upload di una immagini o allegati
come pdf,csv,ecc.

##- RenderImage.js

Oggetto per la renderizzazione di un'immagine proveniente da campo.

##- RenderInput.js

oggetto per la gestione degli input standard.

##- RenderInputHelped.js
Oggetto che prevede un input e dei tasti per inserimenti generali, in genere usato
per input che prendono un'insieme di valori predefinito.

##- RenderMap.js
Oggetto per la visualizzazione e la selezione di coordinate gps basato su googlemaps

##- RenderMultiUpload.js

##- RenderSelect.js
Oggetto per la selezione di un valore utilizzando le select

##- RenderSwap.js

##- RenderText.js
##- RenderTextarea.js
##- RenderTexthtml.js
##- RenderTime.js
##- RenderUpload.js