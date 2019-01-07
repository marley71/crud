# Render

La classe `Render` estende la classe `Component` e rappresenta la classe per la gestione di un 
singolo dato. La classe render può essere utilizzata in maniera diretta, ma il loro utilizzo reale è 
come componenti dei singoli dati di una view. Dentro la view un render può essere usato in 3 modi differenti, 
in modalità *edit, search, view*.

La classe Render deve essere consideata come una specie di classe astratta edefinisce alcuni metodi di uso generale e 
i metodi che i veri oggetti Render devono ridefinire per funzionare. Quindi come la classe che 
definisce l'interfaccia dei vari oggetti Render concreti.

il modo è definito nelle costanti
```javascript
Render.VIEW = 'view';
Render.EDIT = 'edit';
Render.SEARCH = 'search';
```

#### Proprietà

- `key` : null - key dell'oggetto render (il campo del db o del field che vogliamo gestire)
- `className` : 'Render' - nome della Classe reale dell'oggetto

- `element_selector` : '[data-render_element]' - marcatore dell'elemento
- `control_selector` : '[data-render_control]' - marcatore del controllo html (input, select, ecc)
- `operator_selector` : '[data-control_operator]' - marcatore dell'input hidden dove è memorizzato l'operatore in caso di modalità 
search
- `operator` : null - valore operatore in caso di modalità search

- `value` : null - valore oggetto
- `app` : null - identificatore dell'oggetto app della pagina viene assegnato a runtime dall'oggetto `App`.
- `resources` : [] - vettore risorse da caricare prima di chiamare il finalize
- `metadata` : {} - array associativo metadati che descrivono il dato
- `htmlAttributes` : {}, attributi html per l'oggetto speciale identificato dal marcatore *control_selector*

#### Metodi

- `init(key,attributes)` - ridefinizione del costruttore rispetto al Component. 
    - @param key : nome del campo
    - @param attributes: attributi/function dell'oggetto che vogliamo ridefinire
- `_setHtmlAttributes(el)` - setta gli attributi presenti nella proprietà `htmlAttributes` all'elemento el
    - @param el : elemento jQuery a cui settare gli attributi
- `change()` : metodo chiamato al momento del change del render.
- `clear()` : medoto da chiamare per il clear del componente render. 
- `setMetadata(metadata)` : setta la proprietà metadata
    - @param metadata : valore associativo che descrivono il dato
- `Render.factory(key,options)` : metodo statico che permette di creare un Render
    - @param key è il nome del campo da creare
    - @param options vettore associativo delle opzioni del render. La factory prende
options.type e options.mode per cercare il nome della classe da istanziare. Se non esistono,
 prende come type 'input' e come mode 'edit'.
    - @return object ritorna il render creato.
 
##### esempio

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
completa per iniziare a creare le nostre applicazioni. Questi renders possono essere ridefiniti e creati di nuovi.
Questo ci permette di cambiare, nella nostra applicazione, aspetto e/o funzionalità. 

I Renders che aggiungeremo saranno fatti l'erediaretà. 

Alcuni `mode` per alcuni render non hanno senso, in questo caso non definire la classe per quel `mode`, questo genererà un errore
che farà capire dell'utilizzo sbagliato del componente Render. [todo: fare esempio]

In tutti i render verranno mostrati:

- il contenuto del metodo template per poter facilmente ridefinire a piacere il vostro template
- i marcatori utilizzati per la gestione corretta del suo comportamento.

---

## RenderInput
Componente per la gestione degli input standard html.

### RenderInputEdit

<a href="http://www.pierpaolociullo.it/example?f=render_input_edit" target="_blank">Esempio</a>

#### template
```html
<input data-render_control type="text" class="form-control" data-placeholder="">
```

- marcatori
    - `data-render_control`: necessario, indica il controllo che riceverà il dato
    - `data-placeholder` : opzionale, eventuale placeholder da utilizzare, verrà fatta la translate sul valore

### RenderInputSearch

<a href="http://www.pierpaolociullo.it/example?f=render_input_search" target="_blank">Esempio</a>

#### template
```html
<input data-render_control type="text" class="form-control" placeholder="">
<input data-control_operator type="hidden" >
```

### RenderInputView

In modalità view, può essere solo uno span. Potevo anche non definirlo, perche' non ha senso un Input in modalità view, 
Io ho scelto di visualizzarlo in uno span, qualcuno potrebbe decidere di farlo visualizzare come un input in modalità
readonly. A voi la scelta.

<a href="http://www.pierpaolociullo.it/example?f=render_input_view" target="_blank">Esempio</a>

#### template
```html
<span data-render_control></span>
```

---

## RenderHidden
Componente per la gestione degli input nascosti. 

### RenderHiddenEdit

<a href="http://www.pierpaolociullo.it/example?f=render_hidden_edit" target="_blank">Esempio</a>

#### template
```html
<input data-render_control type="hidden">
```

- marcatori
    - `data-render_control`: necessario, indica il controllo che riceverà il dato



---

## RenderPassword
Componente per la gestione degli input password.

### RenderPasswordEdit

<a href="http://www.pierpaolociullo.it/example?f=render_password_edit" target="_blank">Esempio</a>

#### template
```html
<input data-render_control type="text" class="form-control" data-placeholder="">
```

- marcatori
    - `data-render_control`: necessario, indica il controllo che riceverà il dato
    - `data-placeholder` : opzionale, eventuale placeholder da utilizzare, verrà fatta la translate sul valore



---

## RenderText

Render text è nato per rappresentare la visualizzazione di un testo. La stessa classe è stata ridefinita
per tutti i 3 modi.

<a href="http://www.pierpaolociullo.it/example?f=render_text_view" target="_blank">Esempio</a>
#### template

```html
<span data-render_control></span>
```
---

## RenderTextarea


### RenderTextareaEdit

<a href="http://www.pierpaolociullo.it/example?f=render_textarea_edit" target="_blank">Esempio</a>

#### template

```html
<textarea data-render_element data-render_control class="form-control" name="" value=""></textarea>
```

### RenderTextareaSearch
<a href="http://www.pierpaolociullo.it/example?f=render_textarea_search" target="_blank">Esempio</a>

```html
<textarea data-render_element data-render_control class="form-control" name="" value=""></textarea>
            <input data-control_operator type="hidden" >
```
### RenderTextareaView

<a href="http://www.pierpaolociullo.it/example?f=render_textarea_view" target="_blank">Esempio</a>

```html
<span data-render_control></span>
```

---

## RenderSelect

Oggetto per la selezione di un valore utilizzando le select


### RenderSelectEdit

<a href="http://www.pierpaolociullo.it/example?f=render_select_edit" target="_blank">Esempio</a>

#### template

```html
<select data-render_control class="form-control" ></select>
```
#### marcatori

### RenderSelectSearch

<a href="http://www.pierpaolociullo.it/example?f=render_select_search" target="_blank">Esempio</a>

#### template

```html
<select data-render_control class="form-control" ></select>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderSelectView

<a href="http://www.pierpaolociullo.it/example?f=render_select_view" target="_blank">Esempio</a>

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

<a href="http://www.pierpaolociullo.it/example?f=render_input_helped_edit" target="_blank">Esempio</a>


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

<a href="http://www.pierpaolociullo.it/example?f=render_input_helped_search" target="_blank">Esempio</a>


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

<a href="http://www.pierpaolociullo.it/example?f=render_image_view" target="_blank">Esempio</a>


#### template
```html
<img data-render_control>
```

#### marcatori

---

## RenderRadio
   
   - caption_selector : '[data-render_caption]' - marcatore 

### RenderRadioEdit

<a href="http://www.pierpaolociullo.it/example?f=render_radio_edit" target="_blank">Esempio</a>

#### template
```html
<label data-render_element class="radio-inline">
  <input data-render_control  type="radio" value=""> <span data-render_caption></span>
</label>
<input data-render_exists type="hidden" >
```

#### marcatori

### RenderRadioSearch

<a href="http://www.pierpaolociullo.it/example?f=render_radio_search" target="_blank">Esempio</a>

#### template
```html
<label data-render_element class="radio-inline">
  <input data-render_control  type="radio" value=""> <span data-render_caption></span>
</label>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderRadioView

<a href="http://www.pierpaolociullo.it/example?f=render_radio_view" target="_blank">Esempio</a>

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

<a href="http://www.pierpaolociullo.it/example?f=render_checkbox_edit" target="_blank">Esempio</a>

#### template
```html
<label data-render_element class="checkbox-inline">
    <input data-render_control type="checkbox" value="">  <span data-render_caption> </span>
</label>
<input data-render_exists type="hidden" >
```

#### marcatori

### RenderCheckboxSearch

<a href="http://www.pierpaolociullo.it/example?f=render_checkbox_search" target="_blank">Esempio</a>

#### template
```html
<label data-render_element class="checkbox-inline">
    <input data-render_control type="checkbox" value="">  <span data-render_caption> </span>
</label>
<input data-control_operator type="hidden" >
```

#### marcatori


### RenderCheckboxView

<a href="http://www.pierpaolociullo.it/example?f=render_checkbox_view" target="_blank">Esempio</a>


#### template
```html
<div data-render_element class="checkbox-inline">
    <i data-class="icon_class" ></i> <span data-field="text"> </span>
</div>
```

#### marcatori

---

## RenderCaptcha

Questo render incapsula il captca con il suo relativo reload. Esiste solo in modalità edit


### RenderCaptchaEdit

<a href="http://www.pierpaolociullo.it/example?f=render_captcha_edit" target="_blank">Esempio</a>

#### template
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

#### marcatori
- captcha_img_selector : '[data-captcha_img]'


---


## RenderCustom
  
Oggetto per chi vuole poter modificare l'html da renderizzare. Qui si può inserire 
tutto quello che si vuole utilizzando che chiamate render e finalize. Le tre classi sono
uguali.

### RenderCustomEdit

<a href="http://www.pierpaolociullo.it/example?f=render_custom_edit" target="_blank">Esempio</a>

#### template
```html
<div data-render_element data-render_control></div>
```

#### marcatori

- data-render_element
- data-render_control


---



## RenderDecimal

Oggetto per la gestione dei decimali con parte intera e decimale gestiti separatamente.

### RenderDecimalEdit

<a href="http://www.pierpaolociullo.it/example?f=render_decimal_edit" target="_blank">Esempio</a>

#### template
```html
<div class="input-group" data-render_element>
    <span class="input-group-addon hide symbol_left" data-render_symbol></span>
    <input class="form-control text-right" type="text" data-render_control_int>
    <span class="input-group-addon">,</span>
    <input class="form-control text-right" type="text" data-render_control_dec>
    <input type="hidden" data-render_control="">
    <span class="input-group-addon hide symbol_right" data-render_symbol></span>
</div>
```

#### marcatori

### RenderDecimalSearch

<a href="http://www.pierpaolociullo.it/example?f=render_decimal_search" target="_blank">Esempio</a>

#### template
```html
<div class="input-group" data-render_element>
    <span class="input-group-addon hide symbol_left" data-render_symbol></span>
    <input class="form-control text-right" type="text" data-render_control_int>
    <span class="input-group-addon">,</span>
    <input class="form-control text-right" type="text" data-render_control_dec>
    <input type="hidden" data-render_control="">
    <span class="input-group-addon hide symbol_right" data-render_symbol></span>
    <input data-control_operator type="hidden" >
</div>
```

#### marcatori


### RenderDecimalView

<a href="http://www.pierpaolociullo.it/example?f=render_decimal_view" target="_blank">Esempio</a>

#### template
```html
<div data-render_element class="text-right">
    <span class="hide symbol_left" data-render_symbol></span>
    <span class="text-right" data-render_control_int></span>
    <span class="hide symbol_right text-left" data-render_symbol></span>
</div>
```

#### marcatori


---


## RenderAutocomplete

Questo render è stato pensato per il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata nel input nascosto.
Esiste solo in modalità edit che si chiama `RenderAutocompleteEdit`


### RenderAutocompleteEdit

<a href="http://www.pierpaolociullo.it/example?f=render_autocomplete_edit" target="_blank">Esempio</a>

#### template
```html
<div class="input-group">
    <span style="height:19px" class="input-group-addon" id="basic-addon1" data-render_autocomplete_view data-lang="autocomplete-nonselezionato"></span>
    <input data-render_control type="hidden" name="" value="">
    <div data-render_element class="autosuggest" data-minLength="1" data-queryURL="">
        <input data-render_autocomplete_input type="text" name="src" placeholder="" class="form-control typeahead" />
    </div>
</div>
```


#### Proprietà
- `routeName` : 'autocomplete' - nome della route da utilizzare per reperire i dati dal server
- `autocomplete_view_selector` : '[data-render_autocomplete_view]' - marcatore dove verrà visualizzato
le info della entry scelta
- `autocomplete_input_selector` : '[data-render_autocomplete_input]' - marcatore dove verrà agganciato
il plugins typehead di bootstrap.

- `fields` : [],                // campi su cui effettuare la ricerca, vengono messi come parametro field nella 
richiesta al server
- labelFields : [] , campi da utilizzare nella visualizzazione della selectbox e nel campo label dell'item scelto
- `metadata` :
```javascript
{
    modelData : null,           // dati del modello selezionato
    autocompleteModel : null,   // nome modello da utilizzare nelle chiamate rest per la popolazione dei dati
    method : null,              // eventuale parametro da mandare in get nella chiamata rest
    separator : null,           // separatore da utillare nella visualizzazione dei campi in caso siano piu' di uno
    n_items : null,             // numero di items da richiedere
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


#### Metodi

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



## RenderBelongsto

Questo render è solo per la visualizzazione di dati più complessi che non sono formati da un solo
valore, in genere viene utilizzato per la rappresentazione di campi di una tabella
esterna rispetto a campo corrente, istanza

### RenderBelongstoView

<a href="http://www.pierpaolociullo.it/example?f=render_belongsto_view" target="_blank">Esempio</a>

#### marcatori
- data-render_element


#### template
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

#### Proprietà
- separator : null,
- fields: [],
- nullLabel : '',


    getValue : function () {
        var self = this;
        return self.value;
    },

});

---

## RenderDateSelect


Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza le selectbox html per l'inserimento di una data.
E' fromato da una classe base `DateSelectCommon` che ha i metodi comuni alle 3 viste.


#### Proprietà

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

#### Metodi

- _setDateControls : function () - 
- _changeDate : function () - 
- setValue : function (value) 
- getValue : function () 
- clear : function ()
- getDisplayFormat : function()
- getFormat : function () 


### RenderDateSelectEdit

Estende DateSelectCommon e si preoccupa della gestione della data in modalità edit.

<a href="http://www.pierpaolociullo.it/example?f=render_date_select_edit" target="_blank">Esempio</a>


#### marcatori:

- `data-render_element` : container di tutto il render
- `data-render_control` : input per la form che conterrà il valore da spedire
- `data-render_day_container`
- `data-render_day` : select associata al giorno
- `data-render_month_container`
- `data-render_month` : select associata al mese
- `data-render_year_container`
- `data-render_year` : select associata all'anno

#### template
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

### RenderDateSelectSearch

Estende `RenderDateSelectEdit` ridefinendo al render dove aggiunge il controllo per l'operatore di ricerca
e cambia i nomi per la convenzione con view search

<a href="http://www.pierpaolociullo.it/example?f=render_date_select_search" target="_blank">Esempio</a>

### RenderDateSelectView

Estende `DateSelectCommon`  

<a href="http://www.pierpaolociullo.it/example?f=render_date_select_view" target="_blank">Esempio</a>

marcatori

- data-render_element: container dove verrà visualizzata la data

template 
```html
<span data-render_element></span>
```

#### Metodi

- getValue
- setValue


## RenderDatePicker
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

### RenderDatePickerEdit

<a href="http://www.pierpaolociullo.it/example?f=render_date_picker_edit" target="_blank">Esempio</a>

#### template
```html
<div data-render_element>
    <input data-render_control="" type="hidden" />
    <div class="input-group">
        <input data-render_picker class="form-control text-right" autocomplete="off" />
        <a data-clear class="input-group-addon" href="javascript:void(0)"><span ><i class="fa fa-times"></i></span></a>
    </div>
</div>
```


### RenderDatePickerSearch

<a href="http://www.pierpaolociullo.it/example?f=render_date_picker_search" target="_blank">Esempio</a>

#### template
```html
<div data-render_element>
    <input data-render_control="" type="hidden" />
    <input data-control_operator type="hidden" >
    <div class="input-group">
        <input data-render_picker class="form-control text-right" autocomplete="off" />
        <a data-clear class="input-group-addon" href="javascript:void(0)"><span ><i class="fa fa-times"></i></span></a>
    </div>
</div>
```


### RenderDatePickerView

<a href="http://www.pierpaolociullo.it/example?f=render_date_picker_view" target="_blank">Esempio</a>



#### template

```html
<span data-render_element></span>
```

## RenderDateFormatted
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker nativo del broswer associato al type=date, se supportato.

### RenderDateFormattedEdit

<a href="http://www.pierpaolociullo.it/example?f=render_date_formatted_edit" target="_blank">Esempio</a>

#### template
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


### RenderDateFormattedSearch

<a href="http://www.pierpaolociullo.it/example?f=render_date_formatted_search" target="_blank">Esempio</a>

#### template
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



### RenderDateFormattedView

<a href="http://www.pierpaolociullo.it/example?f=render_date_formatted_view" target="_blank">Esempio</a>

#### template
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


## RenderBetweenDateSelect

Questo render serve per la gestione di un range di date.

### RenderBetweenDateSelectEdit

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_select_edit" target="_blank">Esempio</a>

#### template

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


### RenderBetweenDateSelectSearch

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_select_search" target="_blank">Esempio</a>

#### template

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

### RenderBetweenDateSelectView

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_select_view" target="_blank">Esempio</a>

#### template

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


---

## RenderBetweenDatePicker

Questo render serve per la gestione di un range di date.

### RenderBetweenDatePickerEdit

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_picker_edit" target="_blank">Esempio</a>

#### template

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

### RenderBetweenDatePickerSearch

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_picker_search" target="_blank">Esempio</a>

#### template

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



### RenderBetweenDatePickerView

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_picker_view" target="_blank">Esempio</a>

#### template

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



---



## RenderBetweenDateFormatted

Questo render serve per la gestione di un range di date.

### RenderBetweenDateFormattedEdit

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_formatted_edit" target="_blank">Esempio</a>

#### template

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



### RenderBetweenDateFormattedSearch

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_formatted_search" target="_blank">Esempio</a>

#### template

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

### RenderBetweenDateFormattedView

<a href="http://www.pierpaolociullo.it/example?f=render_between_date_formatted_view" target="_blank">Esempio</a>

#### template

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



---


## RenderHasmany

Oggetto per la gestione delle relazioni esterne. Permette l'inserimento e visualizzazione
di relazioni esterne in un'unica form. Questo render definisce due template quello dell'hasmany
che e' formato di tanti itemTemplate.


### RenderHasmanyEdit

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_edit" target="_blank">Esempio</a>

#### template
```html
<div class="" data-render_element >
    <div class="col col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading" data-hasmany_title></div>
            <div class="panel-body">
                <p data-hasmany_title_msg></p>
                <ul class="list-unstyled sort_class hasmany-list" data-render_list >
                    <!--  -- contenitore hasmany -- -->
                </ul>
            </div>
            <div class="panel-footer">
                <div >
                    <div data-render_limit class="hide">
                        <!-- Limite massimo raggiunto -->
                    </div>
                    <button data-button_add data-pk="" type="button" class="btn btn-primary">
                        <span data-label="app.add"></span>&nbsp;
                        <span data-label="modelMetadata.singular"></span>&nbsp;
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
```

#### itemTemplate
```html
<li class="col col-lg-6 col-md-6 col-sm-12 col-xs-12" data-hasmany_item_structure>
    <div class="clearfix" >
        <div class="clearfix" >
            <span class="pull-left button-move">
                <i class="fa fa-arrows"></i>        
            </span>
            <span class="pull-right btn btn-xs btn-danger" data-button_delete>
                <i class="fa fa-close"></i>        
            </span>
        </div>
        <div class="col col-sm-12" data-hasmany_item> 
        </div>

    </div>
    <hr />
</li>
```


#### marcatori


#### proprietà

- resources : ['jquery-sortable.js']
- _views : [],
- jsonData : null,
- limit : null,
- limitMessage : null
- separator : null,
- fields : [],
- metadata : 
```javascript
{
    modelRelativeName : null,
    relationName : null,
}
```

    
    
#### metodi

- renderNewItem(values),
- deleteHasManyItem(viewIndex) 
- getJsonData(callback) 
- _bindDeleteEvents()
- _checkLimit()
       


### RenderHasmanyView

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_view" target="_blank">Esempio</a>

#### template
```html
<div data-render_element>
    <div class="list-unstyled" data-render_list >
        <ul class="list-unstyled" data-field="items" data-self>
            <!--  -- contenitore lista hasmany -- -->
        </ul>
    </div>
</div>
```
#### itemTemplate 
```html
<li>
    <span data-field="label" ></span>
</li>
```

#### marcatori



---




## RenderHasmanyThrough

Oggetto per la gestione degli hasmany trought...

#### proprietà
- selected : [],
- modelName : "none",
- last_searched_result : null,  // json risultato dell'ultima ricerca
- hasmany_container : '[data-hasmany_container]',
- selected_container : '[data-selected_container]',
- title_selector : '[data-render_title]',
- removeActionOptions : null, // eventuali classi per il bottone
- morph : null,
- //label_field : null,
- labelFields : ['label'],  // campi che verranno visualizzati per gli elementi presenti
- hiddenFields : ['id','status'],
- labelFieldsConfig : {}, // configurazioni speciali per i label fields default sono text

- addNew : false,

- searchField : null,
- searchDescription : null,
- searchMethod : null,

- itemAddTemplate : null,
- itemViewTemplate : null,
- listItemsTemplate : null,

- metadata : {
    autocompleteModel : null,
  },

#### metodi
- _populateItem : function(values,container) {
- _populate : function (filter) {


### RenderHasmanyThroughEdit

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_through_edit" target="_blank">Esempio</a>


#### proprietà
- resources : [ 'jquery-sortable.js']
- _views : [],

#### metodi

- itemExist : function (values) {
- addItem : function (values) {
- deleteItem : function (vkey) {

#### template
```html
<div class="" data-render_element >
    <div class="col col-sm-12" >
        <div class="panel panel-info">
           <div class="panel-heading" data-render_title>

           </div>
           <div class="panel-body padding-3">

               <div class="col col-md-4 col-sm-12 padding-6 panel panel-default panel-body" >
                   <h5>Elementi selezionati</h5>
                   <ul class="list-unstyled sort_class " data-selected_container>
                   </ul>

               </div>
                  <div class="col col-md-8 col-sm-12 padding-15" data-template="searched">

                      

                  </div>
           </div>
        </div>
    </div>
</div>
```

#### itemTemplate
template utilizzato per la visualizzazione degli elementi ricercati
```html
<li data-item class="col col-md-6 col-sm-12 col-xs-12">
   <div class="fullwidth">
    <span style="pointer:hand" class="btn btn-xs btn-primary" data-add data-id data-label data-morph_type data-morph_id data-attrs="{'data-id':id,'data-label':label,'data-morph_type':morph_type,'data-morph_id':morph_id}">
        <i class="fa fa-plus"></i>
    </span>
   <span data-field='label'></span>
   </div>
</li>
```

#### searchedTemplate
template utilizzato per la sezione di ricerca del render
```html
<div class="input-group margin-bottom-10">
    <span class="input-group-addon " style="cursor:pointer">
        <i class="fa fa-search"></i>
        <!--
        <button class="btn btn-default btn-sm" type=button data-lang="general-search">Go</button>-->
    </span>
    <input class="form-control "  data-search type="text" value="" data-placeholder="Inserire parole da ricercare">
    <span data-button_add class="input-group-addon ">
        <i  class="fa fa-plus"></i>
    </span>
</div>

<div class= style="position:relative; overflow:hidden;">
    <ul class="list-unstyled list-hover list-inline" data-hasmany_container data-slimscroll-visible="false" style="overflow: auto; width: auto; min-height: 60px;">
    
    </ul>
</div>
```

#### viewTemplate
template utilizzato per visualizzare la view interna
```html
<div>
    <div data-view_action></div>
    <div data-hidden_fields></div>
    <div class="clearfix" >
        <div class="" data-view_elements></div>
       
    </div>
</div>
```

#### addedItemTemplate
template utilizzato per creare l'elemnto lista dove verrà visualizzata la view interna
```html
<li class="padding-bottom-6 border-bottom-1" data-hasmany_through_item>
               
</li>
```

#### marcatori

- data-hasmany_through_item


### RenderHasmanyThroughView

Questo è in modalità view con itemTemplate base, in caso di item piu' complessi ridefinire itemTemplate
aggiungendo l'attributo data-field="nome_campo" nel item html che si voglia usare per visualizzarlo


<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_through_view" target="_blank">Esempio</a>


#### template
```html
<div data-render_element>
    <ul class="list-unstyled" data-render_list data-field="items" data-self>
        <!--  -- contenitore lista hasmany data dal template  default_hasmany_view_items_tpl-- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li >
    <span data-field="__label__"></span>
</li>
```

#### marcatori



---




## RenderHasmanyUploadImage

Oggetto per la gestione di hasmany che prevedono un upload di una o più immagini 

#### proprietà


- uploadConfView : 'ConfEdit',            // configurazione di default della upload view
- limit : null,
- modelName : null,
- uploadModelName : null,
- routeName : 'uploadfile',
- vkey : null,
- labelField : 'filename',
- uploadFields : ['ext','random','id','status','original_name','filename','mimetype','modelName','type'],
- fields : ['nome','descrizione'],
- fields_config : {
- nome : { type : 'input'},
- descrizione : {type : 'textarea'},
- },
- mainformFields : ['nome','descrizione','original_name','filename','ext','random','id','status','mimetype'],
- icon_selector : "[data-icon_img]",


#### metodi
- _showItemUploadedPreview : function (container,values) {
- _bindActions : function () {    aggancia gli eventi sui pulsanti degli upload
-  _checkLimit : function () {/**
       * controlla se e' stato raggiunto il limite degli upload inseribili. In quel caso
       * nasconde il bottone aggiungi
       */
- renderNewItem : function (values) {
- deleteItem : function (index) {
-  /**
       * azione ok della popup che richiede l'upload dell'oggetto
       */
      ok : function(dialog) {
- /**
       * azione cancel della popup
       */
      cancel : function () {
- _setUploadFieldsType : function () {
- _setFieldsType : function () {
- /**
       * metodo chiamato dopo che il file e' stato uploadato
       * @param data: dati in json ritornati dal backend
       */
      afterUpload : function (data) {
      },ù

     

### RenderHasmanyUploadImageEdit

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_upload_image_edit" target="_blank">Esempio</a>


#### proprietà

-  traits : ['TraitUpload'],
- resources : ['jquery.form.js','jquery-sortable.js'],

#### metodi

- /**
       * crea l'item html da aggiungere alla form principale della view
       **/
      _createItem : function (values,status) {
- 


#### dialogContentTemplate
```html
    <div id="loader_foto"></div>
    <form enctype="multipart/form-data" method="POST"
        action="" encoding="multipart/form-data"
        name="formupload">
        <div data-custom_html>

        </div>
        <table class="table">
            <tr>
                <td>
                    <div >
                        <span data-label="app.accepted-extensions"></span>:</div>
                        <div data-label="app.extensions-foto"></div>
                        <div >Max <span data-label="app.upload-max-filesize" ></span> 
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <input class="btn btn-default" type="file" name="file">
                    </div>
                </td>
                <td>
                    <div >
                        <div data-preview data-field="data"></div>
                    </div>
                </td>
                <td>

                </td>
            </tr>
        </table>
        <div data-view_container>
    
        </div>
    </form>
```

#### template

```html
<div class="" data-render_element >
   <div class="col col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" data-upload_title data-label="modelMetadata.singular">
                <br/>
                <span><small data-foto-msg></small></span>
            </div>
            <div class="panel-body">
                <ul class="list-group sort_class list-inline" data-render_list >
                <!--  -- contenitore lista fotos -- -->
                </ul>
                <div>
                    <div data-render_limit data-lang="general-max_limit_reached"></div>
                    
                </div>
            </div>
            <div class="panel-footer">
                <div>
                    <button data-button_add data-pk="" type="button" class="btn btn-primary">
                        <span data-label="app.add"></span> <span data-label="model.foto"></span>
                    </button>
                </div>
            </div>
        </div>
   </div>
</div>
```


#### itemTemplate

```html
<li class="list-unstyled" data-upload_item>
    <div class="col col-sm-12 thumbnail">
        <div data-model_fields></div>
        <div class="clearfix">
            <small class="pull-left" data-field="label" data-trim="12" data-attrs="{title:label}"></small>
            <button class="btn-danger btn-xs pull-right" type="button" data-button_delete data-pk="" title="Cancella Foto"><i class="fa fa-times-circle"></i></button>

        </div>
        <div data-preview data-field="data"></div>
    </div>
</li>
```

#### previewItemTemplate

```html
<img data-icon class="button-move" src="" data-attrs="{src:(typeof urls !== 'undefined')?Server.getUrl(urls+'small'):Server.getUrl('/imagecache/small/'+filename)}">
```



#### marcatori



### RenderHasmanyUploadImageView

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_upload_image_view" target="_blank">Esempio</a>


#### template
```html
<div data-render_element>
    <ul class="list-unstyled" data-render_list >
        <!--  -- contenitore lista fotos -- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li>
    <img class="img-circle img-list" src="" data-attrs="{src:Server.getUrl(urls+'icon')}" />
</li>
```


#### marcatori


---




## RenderHasmanyUploadAttachment

Oggetto per la gestione di hasmany che prevedono un upload di allegati come pdf,csv,ecc.


#### proprietà

- uploadConfView : 'ConfEdit',            // configurazione di default della upload view
- //langs : ['it'],
- limit : null,
- modelName : null,
- uploadModelName : null,
- routeName : 'uploadfile',
- iconSize : 'default',
- icons :

```javascript 
 {
        default : {
            "default"   : 'fa fa-2x fa-file-o',
            "xls"       : 'fa fa-2x fa-file-excel-o',
            "zip"       : 'fa fa-2x fa-file-archive-o',
            "mp3"       : 'fa fa-2x fa-audio-o',
            "jpg"       : "fa fa-2x fa-image-o",
            "pdf"       : "fa fa-2x fa-file-pdf-o",
            "txt"       : "fa fa-2x fa-file-text-o",
        },
        big : {
            "default"   : 'fa fa-3x fa-file-o',
            "xls"       : 'fa fa-3x fa-file-excel-o',
            "zip"       : 'fa fa-3x fa-file-archive-o',
            "mp3"       : 'fa fa-3x fa-audio-o',
            "jpg"       : "fa fa-3x fa-image-o",
            "pdf"       : "fa fa-3x fa-file-pdf-o",
            "txt"       : "fa fa-3x fa-file-text-o",
        },
        small : {
            "default"   : 'fa fa-file-o',
            "xls"       : 'fa fa-file-excel-o',
            "zip"       : 'fa fa-file-archive-o',
            "mp3"       : 'fa fa-audio-o',
            "jpg"       : "fa fa-image-o",
            "pdf"       : "fa fa-file-pdf-o",
            "txt"       : "fa fa-file-text-o",
        }
    }
```

- vkey : null,
- labelField : 'filename',
- uploadFields : ['ext','random','id','status','original_name','filename','mimetype','modelName','type'],
- fields : ['nome','descrizione'],
- fields_config :
```javascript
{
    nome : { type : 'input'},
    descrizione : {type : 'textarea'},
}
```
- mainformFields : ['nome','descrizione','original_name','filename','ext','random','id','status','mimetype'],
- icon_selector : "[data-icon]",

#### metodi

- _showItemUploadedPreview : function (container,values) {
- _bindActions : function () {
- _checkLimit : function () {
- renderNewItem : function (values) {
- deleteItem : function (index) {
- ok : function(dialog) {
- cancel : function () {
- _setUploadFieldsType : function () {
- _setFieldsType : function () {
- afterUpload : function (data) {

### RenderHasmanyUploadAttachmentEdit

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_upload_attachment_edit" target="_blank">Esempio</a>


#### proprietà

- traits : ['TraitUpload'],
- resources : ['jquery.form.js','jquery-sortable.js'],
      
#### metodi

- _createItem : function (values,status)



#### template
```html
<div class="" data-render_element >
   <div class="col col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" data-upload_title>
                <br/>
                <span><small data-foto-msg></small></span>
            </div>
            <div class="panel-body">
                <ul class="list-group sort_class list-inline" data-render_list >
                <!--  -- contenitore lista fotos -- -->
                </ul>
                <div>
                    <div data-render_limit data-lang="general-max_limit_reached"></div>
                    
                </div>
            </div>
            <div class="panel-footer">
                <div>
                    <button data-button_add data-pk="" type="button" class="btn btn-primary">
                        <span data-label="app.add"></span> <span data-label="model.attachment"></span>
                    </button>
                </div>
            </div>
        </div>
   </div>
</div>
```


####  previewItemTemplate

```html
<span class="button-move">
    <i data-icon></i>
</span>
```


#### itemTemplate

```html
<li class="list-unstyled" data-upload_item>
    <div class="col col-sm-12 thumbnail">
        <div data-model_fields></div>
        <div class="clearfix">
            <small class="pull-left" data-field="label" data-trim="12" data-attrs="{title:label}"></small>
            <button class="btn-danger btn-xs pull-right" type="button" data-button_delete data-pk="" title="Cancella Foto"><i class="fa fa-times-circle"></i></button>

        </div>
        <div data-preview data-field="data"></div>
    </div>
</li>
```


#### dialogContentTemplate

```html
    <div id="loader_foto"></div>
    <form enctype="multipart/form-data" method="POST"
        action="" encoding="multipart/form-data"
        name="formupload">
        <div data-custom_html>

        </div>
        <table class="table">
            <tr>
                <td>
                    <div >
                        <span data-label="app.accepted-extensions"></span>:</div>
                        <div data-label="app.extensions-attachment"></div>
                        <div >Max <span data-label="app.upload-max-filesize" ></span> 
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <input class="btn btn-default" type="file" name="file">
                    </div>
                </td>
                <td>
                    <div >
                        <div data-preview data-field="data"></div>
                    </div>
                </td>
                <td>

                </td>
            </tr>
        </table>
        <div data-view_container>
    
        </div>
    </form>
```

#### marcatori


### RenderHasmanyUploadAttachmentView

<a href="http://www.pierpaolociullo.it/example?f=render_hasmany_upload_attachment_view" target="_blank">Esempio</a>


#### template
```html
<div data-render_element>
    <ul class="list-unstyled" data-render_list >
        <!--  -- contenitore lista fotos -- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li>
    <a class="small" target="_blank" href="#"
            data-href="'/downloadfile/'+id" data-totranslate="true" data-attrs="{'title':full_filename}" data-append="true">
                <i data-class="icon" />
    </a>
</li>
```


#### marcatori



---




## RenderMap

Oggetto per la visualizzazione e la selezione di coordinate gps basato su googlemaps

#### proprietà

- _lat : 0,
- _lng : 0,
- _hasDbValues : false,
- address : null,
- lat_input_selector : '[data-lat_field]',
- lng_input_selector : '[data-lng_field]',
- lat_field_name : 'lat',
- lng_field_name : 'lng',
- //dialogId : '#map_dialog',
- idViewMap : null,
- metadata : 
```javascript
{
      apiKey : null,
      raggioArea : 5000,
      showArea : false,
  }
```


#### metodi

- getIndirizzo : function () {
- _showDialog : function () {
- activateMap : function(dialog,callback,options) {
- 



### RenderMapEdit

<a href="http://www.pierpaolociullo.it/example?f=render_map_edit" target="_blank">Esempio</a>


#### metodi

- ok : function() {
- setValue : function(lat,lng)
- 



#### template
```html
<div data-control_container>
    <button class="btn btn-default" type="button" data-button_map data-label="app.modifymap"></button>
    <div class="clearfix">
       
        <span class="pull-left" >
            <span data-label="app.gpslat"></span>: <input  class="form-control" data-lat_field></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <span class="pull-left">
            <span data-label="app.gpslng"></span>: <input class="form-control" class="badge" data-lng_field></input>
        </span>
    </div>
   
</div>
```

#### dialogContentTemplate 

```html
<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Seleziona coordinate</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Indirizzo:</span>
                                <input type="text" class="form-control" name="indirizzo" aria-describedby="basic-addon1">
                                <span class="input-group-addon" id="basic-addon2"><a data-lnk_address href="javascript:void(0)"  ><i class="fa fa-search"></i> Cerca indirizzo</a></span>
        
                            </div>
                        </div>
                        <div class="col col-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Lat:</span>
                                <input type="text" class="form-control" name="lat" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col col-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Lng:</span>
                                <input type="text" class="form-control" name="lng" aria-describedby="basic-addon1">
        
        
                            </div>
                        </div>
        
                        <!-- <span>Lat:</span> <input  type="text" name="lat"> , <span>Lng:</span> <input type="text" name="lng">  -->
        
        
                    </div>
                    <div data-area_container class="row hide">
                        <div class="col col-xs-12" >
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Cerchio di raggio in metri?</span>
                                <input class="form-control" data-input_raggio type="text" value="1000">
                            </div>
                        </div>
        
        
                        <!-- <span>Lat:</span> <input  type="text" name="lat"> , <span>Lng:</span> <input type="text" name="lng">  -->
                    </div>
                    <div id="gmap" style="width:100%;height:400px"></div>
                </div>
                <div class="modal-footer">
                    <button data-button="cancel" type="button" class="btn btn-primary"
                            data-dismiss="modal">Annulla</button>
                    <button data-button="ok" type="button" class="btn btn-primary"
                            data-dismiss="modal">Ok</button>

                </div>
           </div>
```

#### marcatori

### RenderMapSearch

<a href="http://www.pierpaolociullo.it/example?f=render_map_search" target="_blank">Esempio</a>

#### template
```html
<div data-control_container>
    <button class="btn btn-default" type="button" data-button_map data-label="app.modifymap"></button>
    <div class="clearfix">
        <input type="hidden" name="" data-control_operator>
        <span class="pull-left" >
            <span data-label="app.gpslat"></span>: <input  class="form-control" data-lat_field></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <span class="pull-left">
            <span data-label="app.gpslng"></span>: <input class="form-control" class="badge" data-lng_field></input>
        </span>
    </div>
   
</div>
```

#### marcatori


### RenderMapView

<a href="http://www.pierpaolociullo.it/example?f=render_map_view" target="_blank">Esempio</a>

#### template
```html
<div data-map_container style="width:100%;height:400px"></div>
```

#### marcatori




---




## RenderSwap

#### proprietà
iconClass : {
        0 : 'fa fa-circle text-danger',
        1 : 'fa fa-circle text-success'
    },
    metadata : {
        domainValues : {
            0: 'disattivo',
            1: 'attivo'
        }
    },

#### metodi

- _setHtmlData :function() {
- _swap : function () {
- _callback : function (json) {

### RenderSwapEdit

<a href="http://www.pierpaolociullo.it/example?f=render_swap_edit" target="_blank">Esempio</a>

#### template
```html
<button type="button" class="btn btn-default btn-xs" data-render_element title="">
    <i data-icon class=""></i>
</button>
```

#### marcatori

### RenderSwapSearch

<a href="http://www.pierpaolociullo.it/example?f=render_swap_search" target="_blank">Esempio</a>

#### template
```html
    <input data-render_control type="hidden" class="form-control" name="" value="">
    <input data-control_operator type="hidden" >
    <button type="button" class="btn btn-default btn-xs" data-render_element title="">
        <i data-icon class=""></i>
    </button>
```

#### marcatori

### RenderSwapView

<a href="http://www.pierpaolociullo.it/example?f=render_swap_view" target="_blank">Esempio</a>

#### template
```html
<i data-icon data-render_element class=""></i>
```

#### marcatori


---




## RenderTexthtml

rappresentazione ed editing di testo html




### RenderTexthtmlEdit

editor html summernote.

<a href="http://www.pierpaolociullo.it/example?f=render_texthtml_edit" target="_blank">Esempio</a>

- height : 200,
      pluginOptions : {},
      _pluginObject : null,



#### template
```html
    <textarea data-render_element data-render_control class="summernote form-control" data-summernote-lang="it-IT"></textarea>

```

#### marcatori


### RenderTexthtmlView

<a href="http://www.pierpaolociullo.it/example?f=render_texthtml_view" target="_blank">Esempio</a>

#### template
```html
<div data-render_element data-render_control ></div>
```

#### marcatori



---



## RenderUploadImage

### RenderUploadImageEdit

<a href="http://www.pierpaolociullo.it/example?f=render_upload_image_edit" target="_blank">Esempio</a>

#### template
```html

```

#### marcatori


### RenderUploadImageView

<a href="http://www.pierpaolociullo.it/example?f=render_upload_image_view" target="_blank">Esempio</a>


#### template
```html

```

#### marcatori



---




## RenderUploadAttachment

### RenderUploadAttachmentEdit

<a href="http://www.pierpaolociullo.it/example?f=render_upload_attachment_edit" target="_blank">Esempio</a>


#### template
```html

```

#### marcatori


### RenderUploadAttachmentView

<a href="http://www.pierpaolociullo.it/example?f=render_upload_attachment_view" target="_blank">Esempio</a>


#### template
```html

```

#### marcatori

