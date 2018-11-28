# Render

La classe `Render` estende la classe `Component` e rappresenta la classe per la gestione di un 
singolo dato. La classe render può essere utilizzata in maniera diretta, ma il loro utilizzo reale è 
come componenti dei singoli dati di una view. Dentro la view un render può essere usato in 3 modi differenti, 
in modalità *edit, search, view*.

La classe Render deve essere consideata come una specie di classe astratta edefinisce alcuni metodi di uso generale e 
i metodi che i veri oggetti Render devono ridefinire per funzionare. Dobbiamo considerarla come la classe astratta che 
definisce l'interfaccia da definire nei vari oggetti Render concreti.

il modo è definito nelle costanti
```javascript
Render.VIEW = 'view';
Render.EDIT = 'edit';
Render.SEARCH = 'search';
```

#### Proprietà

- `key` : null - key dell'oggetto render (il campo del db o del field che vogliamo gestire)
- `className` : 'Render' - nome della Classe reale dell'oggetto

- `element_selector` : '[data-render_element]' - marcatore html dell'elemento
- `control_selector` : '[data-render_control]' - marcatore html del controllo html (input, select, ecc)
- `operator_selector` : '[data-control_operator]' - marcatore dell'input hidden dove è memorizzato l'operatore in caso di modalità 
search
- `operator` : null - valore operatore

- `value` : null - valore oggetto
- `app` : null - identificatore dell'oggetto app della pagina viene assegnato a runtime dal componente App.
- `resources` : [] - vettore risorse da caricare prima di chiamare il finalize
- `metadata` : {} - array associativo metadati che descrivono il dato
- htmlAttributes : {},    // attributi html per l'oggetto speciale identificato dal marcatore data-render_control

#### Metodi

- `init(key,attributes)` - ridefinizione del costruttore rispetto al Component. 
    - key : nome del campo
    - attributes: attributi/function dell'oggetto che vogliamo ridefinire
- `_setHtmlAttributes(el)` - setta gli attributi presenti nella proprietò 
- `change()` : metodo chiamato al momento del change del render. L'evento change qui è da intendere come il change
del render e non del singolo controllo html. 
- `clear()` : medoto da chiamare per il clear del componente render. 
- `setMetadata(metadata)` : setta la proprietà metadata


`Render.factory(key,options)` : metodo statico che permette di creare un Render
- key è il nome del campo da creare
- options vettore associativo delle opzioni del render. La factory prende
options.type e options.mode per cercare il nome della classe da istanziare. Se non esistono
 prende come default 'input' come type ed 'edit' come mode.
Il nome da cercare deve rispettare questa convezione:
"Render"+pascalCase(options.type)+pascalCase(options.mode) esempio

```javascript
var r = Render.factory('field', {
    type : 'input_helped',
    mode : 'edit'
})
// la factory cercherà la definizione della classe 'RenderInputHelpedEdit' che rappresenta
// l'oggetto che gestirà il Render InputHelped in modalità edit.
```
    
# Render Implementati

La libreria mette a disposizione dei renders di default per gli usi più comuni, in modo da avere già una base abbastanza
completa per iniziare a creare le nostre applicazioni. Questi possono essere ridefiniti, in caso vogliamo cambiare, 
nella nostra applicazione, aspetto o funzionalità. 

A questi Renders definiti se ne possono aggiungere altri usando l'erediaretà. I renders vengono istanziati in automatico dalle views, 
oppure possono essere istanziati manualmente.

Alcuni modi per alcuni render non hanno senso, in questo caso non definire la classe per quel modo, questo genererà un errore
che farà capire dell'utilizzo sbagliato del componente Render. [todo: fare esempio]

In tutti i render verranno mostrati:

- il contenuto del metodo template per poter facilmente ridefinire a piacere il vostro template
- i marcatori utilizzati per la gestione corretta del suo comportamento.

---

## RenderInput
Componente per la gestione degli input standard html.

### RenderInputEdit

#### template
```html
<input data-render_control type="text" class="form-control" data-placeholder="">
```

- marcatori
    - `data-render_control`: necessario, indica il controllo che riceverà il dato
    - `data-placeholder` : opzionale, eventuale placeholder da utilizzare, verrà fatta la translate sul valore


### RenderInputView
In modalità view, può essere solo uno span. Potevo anche non definirlo, perche' non ha senso un Input in modalità view, 
Io ho scelto di visualizzarlo in uno span, qualcuno potrebbe decidere di farlo visualizzare come un input in modalità
readonly. A voi la scelta.

template
```html
<span data-render_control></span>
```

### RenderInputSearch

template
```html
<input data-render_control type="text" class="form-control" placeholder="">
<input data-control_operator type="hidden" >
```

---

## RenderText

Render text è nato per rappresentare la visualizzazione di un testo. La stessa classe è stata ridefinita
per tutti i 3 modi.


#### template

```html
<span data-render_control></span>
```
---

## RenderTextarea


### RenderTextareaEdit

#### template

```html
<textarea data-render_element data-render_control class="form-control" name="" value=""></textarea>
```

### RenderTextareaSearch

```html
<textarea data-render_element data-render_control class="form-control" name="" value=""></textarea>
            <input data-control_operator type="hidden" >
```
### RenderTextareaView

```html
<span data-render_control></span>
```

---

## RenderSelect

Oggetto per la selezione di un valore utilizzando le select

### RenderSelectEdit

#### template

```html
<select data-render_control class="form-control" ></select>
```
#### marcatori

### RenderSelectSearch

#### template

```html
<select data-render_control class="form-control" ></select>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderSelectView

#### template

```html
<select data-render_control class="form-control" ></select>
```

#### marcatori



---

## RenderInputHelped

Questo Render permette di aggiungere ad un input una serie di valori predefiniti che aiutano l'utilizzatore

####Proprietà

- customValue : true, indica se può essere inserito un valore fuori dal range dei valori predefiniti
- metadata : sono i valori predefiniti vettore associativo valore : 'Testo da visualizzare'
```javascript
{
    domainValues : {}
}
```

//@TODO esempio
    
    
### RenderInputHelpedEdit

#### template
```html
<div data-render_element>
    <input  data-render_control class="form-control" type="text" name="" value="">
    <div data-option_values>
        <div class="btn-group btn-group-xs" role="group" aria-label="..." data-field="data" data-self>
            <button type="button" class="btn btn-default" data-html="label" data-attrs="{'data-value':value}"></button>
        </div>
    </div>
</div>
```

#### marcatori

### RenderInputHelpedSearch

#### template
```html
<div data-render_element>
    <input  data-control_operator class="form-control" type="hidden" name="" value="">
    <input  data-render_control class="form-control" type="text" name="" value="">
    <div data-option_values>
        <div class="btn-group btn-group-xs" role="group" aria-label="..." data-field="data" data-self>
            <button type="button" class="btn btn-default" data-html="label" data-attrs="{'data-value':value}"></button>
        </div>
    </div>
</div>
```

#### marcatori



---

## RenderImage

Oggetto per la renderizzazione di un'immagine proveniente. Esiste solo in modalità view.

### RenderImageView

#### template
```html
<img data-render_control>
```

#### marcatori

---

## RenderRadio
   
   - caption_selector : '[data-render_caption]' - marcatore 

### RenderRadioEdit

#### template
```html
<label data-render_element class="radio-inline">
  <input data-render_control  type="radio" value=""> <span data-render_caption></span>
</label>
<input data-render_exists type="hidden" >
```

#### marcatori

### RenderRadioSearch

#### template
```html
<label data-render_element class="radio-inline">
  <input data-render_control  type="radio" value=""> <span data-render_caption></span>
</label>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderRadioView

#### template
```html
<div data-render_element class="checkbox-inline">
    <i data-class="icon_class" ></i> <span data-field="text"> </span>
</div>
```

#### marcatori


---

## RenderCheckbox
   
   - caption_selector : '[data-render_caption]' - marcatore 

### RenderCheckboxEdit

#### template
```html
<label data-render_element class="checkbox-inline">
    <input data-render_control type="checkbox" value="">  <span data-render_caption> </span>
</label>
<input data-render_exists type="hidden" >
```

#### marcatori

### RenderCheckboxSearch

#### template
```html
<label data-render_element class="checkbox-inline">
    <input data-render_control type="checkbox" value="">  <span data-render_caption> </span>
</label>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderCheckboxView

#### template
```html
<div data-render_element class="checkbox-inline">
    <i data-class="icon_class" ></i> <span data-field="text"> </span>
</div>
```

#### marcatori

---

## RenderSelect

### RenderSelectEdit

#### template
```html

```

#### marcatori

### RenderSelectSearch

#### template
```html

```

#### marcatori


### RenderSelectView

#### template
```html

```

#### marcatori




---


---




#RenderAutocomplete

Questo render è stato pensato per il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata nel input nascosto.
Esiste solo in modalità edit che si chiama `RenderAutocompleteEdit`


## - RenderAutocompleteEdit
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


####Proprietà
- `routeName` : 'autocomplete' - nome della route da utilizzare per reperire i dati dal server
- `autocomplete_view_selector` : '[data-render_autocomplete_view]' - marcatore dove verrà visualizzato
le info della entry scelta
- `autocomplete_input_selector` : '[data-render_autocomplete_input]' - marcatore dove verrà agganciato
il plugins typehead di bootstrap.

- `fields` : [],                // campi da visualizzare dopo la selezione
- `metadata` :
```javascript
{
    modelData : null,           // dati del modello selezionato
    autocompleteModel : null,   // nome modello da utilizzare nelle chiamate rest per la popolazione dei dati
    method : null,              // eventuale parametro da mandare in get nella chiamata rest
    separator : null,           // separatore da utillare nella visualizzazione dei campi in caso siano piu' di uno
    n_items : null,             // numero di items da richiedere
    model_description : []
}
```
- `resources` : vettore delle risorse esterne che ha bisogno per funzionare. Questo render si appoggia a
typeahead bootstrap.
```javascript
[
        'typeahead/bootstrap3-typeahead.min.js',
        'typeahead/typeahead.bundle.js',
        'typeahead/typeaheadjs.css'
]
```


####Metodi

- `_getLabelValue()` : 
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



#RenderBelongsto

Questo render è solo per la visualizzazione di dati più complessi che non sono formati da un solo
valore, in genere viene utilizzato per la rappresentazione di campi di una tabella
esterna rispetto a campo corrente, istanza

## - RenderBelongstoView

marcatori
- data-render_element


template generale
```html
    <div data-render_element></div>
```

itemTemplate : vuoto. Da definire solo se si vuole avere una visualizzazinoe particolare
dei campi. Per esempio supponiamo che il nostro belongsto punti ad una tabella 
clienti con questi dati
```javascript
{
    nome : 'nome',
    cognome : 'cognome',
}
```

```html
<div>
    <span data-field="cognome"></span> altro campo <span data-field="nome"></span>
</div>
```

####Proprietà
- separator : null,
- fields: [],
- nullLabel : '',


    getValue : function () {
        var self = this;
        return self.value;
    },

});

##RenderBelongstoView

- template() : function () {
        return `<div data-render_element></div>`
    },

-itemTemplate : function () {
        return false;
    }



#RenderDateSelect


Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza le selectbox html per l'inserimento di una data.
E' fromato da una classe base `DateSelectCommon` che ha i metodi comuni alle 3 viste.

## - DateSelectCommon

####Proprietà

- year_selector    : '[data-render_year]',
- month_selector    : '[data-render_month]',
- day_selector    : '[data-render_day]',
- picker_selector : '[data-render_picker]',
- h24 : true,
- time : false,
- dateFormat : 'YYYY-MM-DD',
- timeFormat : 'H:i:s',
- resources :[
    'moment-with-locales.min.js',
]
- selectProps : {
        active : ['day','month','year'],    // select active in dateType select
        startYear : (new Date().getFullYear()) -3,
        endYear : (new Date().getFullYear()) +3,
    },

####Metodi

- _setDateControls : function () - 
- _changeDate : function () - 
- setValue : function (value) 
- getValue : function () 
- clear : function ()
- getDisplayFormat : function()
- getFormat : function () 


## - RenderDateSelectEdit

Estende DateSelectCommon e si preoccupa della gestione della data in modalità edit.

####marcatori:

- `data-render_element` : container di tutto il render
- `data-render_control` : input per la form che conterrà il valore da spedire
- `data-render_day_container`
- `data-render_day` : select associata al giorno
- `data-render_month_container`
- `data-render_month` : select associata al mese
- `data-render_year_container`
- `data-render_year` : select associata all'anno

####template
```html
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
```

## - RenderDateSelectSearch

Estende `RenderDateSelectEdit` ridefinendo al render dove aggiunge il controllo per l'operatore di ricerca
e cambia i nomi per la convenzione con view search

## - RenderDateSelectView

Estende `DateSelectCommon`  

marcatori

- data-render_element: container dove verrà visualizzata la data

template 
```html
<span data-render_element></span>
```

####Metodi

- getValue
- setValue


#RenderDatePicker
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

## - RenderDatePickerEdit

####template
```html
<div data-render_element>
    <input data-render_control="" type="hidden" />
    <div class="input-group">
        <input data-render_picker class="form-control text-right" autocomplete="off" />
        <a data-clear class="input-group-addon" href="javascript:void(0)"><span ><i class="fa fa-times"></i></span></a>
    </div>
</div>
```
## - RenderDatePickerView

####template

```html
<span data-render_element></span>
```

#RenderDateFormatted
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker nativo del broswer associato al type=date, se supportato.

## - RenderDateFormattedEdit

####template
```html
<div class="clearfix" data-render_element>
    <input data-render_control="" type="hidden" />
    <div class="col col-xs-6">
        <input data-date_formatted class="form-control" type="date" />
    </div>
    <div class="col col-xs-6">
        <input data-time_formatted class="form-control hide" type="time"/>
    </div>
</div>
```



#RenderBetweenDate

Questo render serve per la gestione di un range di date.

## -  RenderBetweenDateEdit

####template

```html
<div>
    <div class="col col-xs-6">
        <div data-label="app.dal"></div>
        <div data-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div data-label="app.al"></div>
        <div data-render_end></div>
    </div>
</div>
```


#RenderCaptcha

Questo render incapsula il captca con il suo relativo reload

marcatori

- captcha_img_selector : '[data-captcha_img]'

- template() 
```html
<div class="row">
    <div class="col-sm-4" data-captcha_img  >

    </div>
    <div class="col-sm-4">
            <input data-render_control="" class="form-control" type="text" name="" value="">
    </div>
    <div class="col-sm-4">
        <button class="btn btn-sm btn-default" type="button" data-button_reload>Reload</button>
    </div>
</div>
```


#RenderCustom

Oggetto per chi vuole poter modificare l'html da renderizzare. Qui si può inserire
tutto quello che si vuole utilizzando che chiamate render e finalize.

#RenderDecimal

Oggetto per la gestione dei decimali con parte intera e decimale gestiti separatamente.


#RenderHasmany
Oggetto per la gestione delle relazioni esterne. Permette l'inserimento e visualizzazione
di relazioni esterne in un'unica form.

#RenderHasmanyThrough

Oggetto per la gestione degli hasmany trought...

#RenderHasmanyUpload

Oggetto per la gestione di hasmany che prevedo un upload di una immagini o allegati
come pdf,csv,ecc.





#RenderMap
Oggetto per la visualizzazione e la selezione di coordinate gps basato su googlemaps

#RenderMultiUpload



#RenderSwap




#RenderTexthtml

#RenderTime

#RenderUpload
