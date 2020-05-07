# Widget

La classe `Widget` estende la classe `Component` e rappresenta la classe per la gestione di un 
singolo dato. La classe render può essere utilizzata in maniera diretta, ma il loro utilizzo reale è 
come componenti dei singoli dati di una view. Dentro la view un render può essere usato in 3 modi differenti, 
in modalità *edit, search, view*.

La classe Widget deve essere consideata come una specie di classe astratta e definisce alcuni metodi di uso generale e 
i metodi che i veri oggetti Widget devono ridefinire per funzionare. Quindi come la classe che 
definisce l'interfaccia dei vari oggetti Widget concreti. Non dovrebbe mai essere istanziata.


#### Proprietà

- `key` : null - key dell'oggetto render (il campo del db o del field che vogliamo gestire)
- `className` : 'Widget' - nome della Classe reale dell'oggetto

- `element_selector` : '[crud-render_element]' - marcatore dell'elemento
- `control_selector` : '[crud-render_control]' - marcatore del controllo html (input, select, ecc)
- `operator_selector` : '[crud-render_operator]' - marcatore dell'input hidden dove è memorizzato l'operatore in caso di modalità 
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
- `Widget.factory(key,options)` : metodo statico che permette di creare un Widget
    - @param key: è il nome del campo da creare
    - @param options: vettore associativo delle opzioni del render. La factory prende
options.type e options.mode per cercare il nome della classe da istanziare. Se non esistono,
 prende come type 'input' e come mode 'edit'.
    - @return object ritorna il render creato.


- esempio


Facciamo una piccola premessa. Per evitare di dover scrivere tutto il nome della classe Widget è stata adottata la 
sequente convenzione:

- Tutti gli oggetti Widget devono avere il nome che inizia per _Widget_
- ogni Widget può avere 3 classi. Una per ogni modalità. view una per la gestione in 
modalità search e una in modalità edit. Supponiamo di aver pensato il nostro render e di chiamarlo _input_. allora dovremmo
creare una o tutte e tre le classi: 
    - `WidgetInputView` : oggetto che gestirà la visualizzazione di input in modalità view.
    - `WidgetInputEdit` : oggetto che gestirà la visualizzazione di input in modalità edit.
    - `WidgetInputSearch` : oggetto che gestirà la visualizzazione di input in modalità search

Ecco il codice da scrivere

```javascript
var r = Widget.factory('fieldName', {
    type : 'input',
    mode : 'edit'
})
// la factory cercherà la definizione della classe 'WidgetInputEdit' che rappresenta
// l'oggetto che gestirà il Widget Input in modalità edit.
// nei nomi si puo' utilizzare _, la factory applichera' il camelCase
// per esempio

var r = Widget.factory('fieldName', {
    type : 'input_colorato',
    mode : 'edit'
})
// la factory cercherà L'esistenza della classe RenderInputColoratoEdit
```

# Render Implementati

La libreria mette a disposizione dei renders di default per gli usi più comuni, in modo da avere già una base abbastanza
completa per iniziare a creare le nostre applicazioni. Questi renders possono essere ridefiniti e creati di nuovi.
Questo ci permette di cambiare, nella nostra applicazione, aspetto e/o funzionalità. 

Alcuni `mode` per alcuni render non hanno senso, in questo caso non definiamo la classe per quel `mode`, 
questo genererà un errore che farà capire dell'utilizzo sbagliato del componente Render.
Nei vari renders implementati alcuni saranno solo in modaltità _edit_.

Per ogni Render implementato mostreremo la classe per ogni mode e per ogni mode:

- il contenuto del metodo template.
- i marcatori utilizzati per la gestione corretta del suo comportamento.

---

## RenderInput
Componente per la gestione degli input standard html.

### RenderInputEdit

Rappresenta la versione di RenderInput in modalità edit.

```javascript
{{{example_render_input_edit}}}
```
<a href="http://www.pierpaolociullo.it/example?f=example_render_input_edit" target="_blank">Provalo online</a>

- template
```html
<input crud-render_control type="text" class="form-control" crud-placeholder="">
```

- marcatori
    - `crud-render_control`: necessario, indica il controllo che riceverà il dato
    - `crud-placeholder` : opzionale, eventuale placeholder da utilizzare, verrà fatta la translate sul valore

### RenderInputSearch
Rappresenta la versione di RenderInput in modalità search. Notate che il template non e' solo dell'input per il dato
ma viene accompagnato da un input nascosto che conterrà il valore dell'operatore. Per convenzione il nome di questo
campo in input sarà s_{nome_field}_operator. Questa convenzione si può ridefinire andando a sovrascrivere la sequente funzione


```javascript
{{{example_render_input_search}}}
```
<a href="http://www.pierpaolociullo.it/example?f=example_render_input_search" target="_blank">Provalo online</a>

- template
```html
<input crud-render_control type="text" class="form-control" placeholder="">
<input crud-render_operator type="hidden" >
```

### RenderInputView

In modalità view, può essere solo uno span. Potevo anche non definirlo, perche' non ha senso un Input in modalità view, 
Io ho scelto di visualizzarlo in uno span, qualcuno potrebbe decidere di farlo visualizzare come un input in modalità
readonly. A voi la scelta.

- esempio

```javascript
{{{example_render_input_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_input_view" target="_blank">Provalo online</a>

- template
```html
<span crud-render_control></span>
```

---

## RenderHidden
Componente per la gestione degli input nascosti. 

### RenderHiddenEdit

- esempio

```javascript
{{{example_render_hidden_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hidden_edit" target="_blank">provalo online</a>

- template
```html
<input crud-render_control type="hidden">
```

- marcatori
    - `crud-render_control`: necessario, indica il controllo che riceverà il dato



---

## RenderPassword
Componente per la gestione degli input password.

### RenderPasswordEdit

- esempio

```javascript
{{{example_render_password_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_password_edit" target="_blank">provalo online</a>

- template
```html
<input crud-render_control type="text" class="form-control" crud-placeholder="">
```

- marcatori
    - `crud-render_control`: necessario, indica il controllo che riceverà il dato
    - `crud-placeholder` : opzionale, eventuale placeholder da utilizzare, verrà fatta la translate sul valore



---

## RenderText

Render text è nato per rappresentare la visualizzazione di un testo. La stessa classe è stata ridefinita
per tutti i 3 modi.

- esempio

```javascript
{{{example_render_text_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_text_view" target="_blank">provalo online</a>
- template

```html
<span crud-render_control></span>
```
---

## RenderTextarea


### RenderTextareaEdit

- esempio

```javascript
{{{example_render_textarea_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_textarea_edit" target="_blank">provalo online</a>

- template

```html
<textarea crud-render_element crud-render_control class="form-control" name="" value=""></textarea>
```

### RenderTextareaSearch

- esempio

```javascript
{{{example_render_textarea_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_textarea_search" target="_blank">provalo online</a>

```html
<textarea crud-render_element crud-render_control class="form-control" name="" value=""></textarea>
            <input crud-render_operator type="hidden" >
```
### RenderTextareaView

- esempio

```javascript
{{{example_render_textarea_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_textarea_view" target="_blank">provalo online</a>

```html
<span crud-render_control></span>
```

---

## RenderSelect

Oggetto per la selezione di un valore utilizzando le select


### RenderSelectEdit

- esempio

```javascript
{{{example_render_select_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_select_edit" target="_blank">provalo online</a>

- template

```html
<select crud-render_control class="form-control" ></select>
```
- marcatori

### RenderSelectSearch

- esempio

```javascript
{{{example_render_select_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_select_search" target="_blank">provalo online</a>

- template

```html
<select crud-render_control class="form-control" ></select>
<input crud-render_operator type="hidden" >
```

- marcatori


### RenderSelectView

- esempio

```javascript
{{{example_render_select_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_select_view" target="_blank">provalo online</a>

- template

```html
<select crud-render_control class="form-control" ></select>
```

- marcatori



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

### RenderInputHelpedEdit


- esempio

```javascript
{{{example_render_input_helped_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_input_helped_edit" target="_blank">provalo online</a>


- template
```html
<div crud-render_element>
    <input  crud-render_control class="form-control" type="text" name="" value="">
    <div crud-option_values>
        <div class="btn-group btn-group-xs" role="group" aria-label="..." crud-field="data" crud-self>
            <button type="button" class="btn btn-default" crud-html="label" crud-attrs="{'crud-value':value}"></button>
        </div>
    </div>
</div>
```

- marcatori

### RenderInputHelpedSearch

- esempio

```javascript
{{{example_render_input_helped_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_input_helped_search" target="_blank">provalo online</a>


- template
```html
<div crud-render_element>
    <input  crud-render_operator class="form-control" type="hidden" name="" value="">
    <input  crud-render_control class="form-control" type="text" name="" value="">
    <div crud-option_values>
        <div class="btn-group btn-group-xs" role="group" aria-label="..." crud-field="data" crud-self>
            <button type="button" class="btn btn-default" crud-html="label" crud-attrs="{'crud-value':value}"></button>
        </div>
    </div>
</div>
```

- marcatori



---

## RenderImage

Oggetto per la renderizzazione di un'immagine proveniente. Esiste solo in modalità view.

### RenderImageView

- esempio

```javascript
{{{example_render_image_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_image_view" target="_blank">provalo online</a>


- template
```html
<img crud-render_control>
```

- marcatori

---

## RenderRadio
   
   - caption_selector : '[crud-render_caption]' - marcatore 

### RenderRadioEdit

- esempio <a href="http://www.pierpaolociullo.it/example?f=example_render_radio_edit" target="_blank">provalo online</a>

```javascript
{{{example_render_radio_edit}}}
```




- template
```html
<label crud-render_element class="radio-inline">
  <input crud-render_control  type="radio" value=""> <span crud-render_caption></span>
</label>
<input crud-render_exists type="hidden" >
```

- marcatori

### RenderRadioSearch

- esempio

```javascript
{{{example_render_radio_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_radio_search" target="_blank">provalo online</a>

- template
```html
<label crud-render_element class="radio-inline">
  <input crud-render_control  type="radio" value=""> <span crud-render_caption></span>
</label>
<input crud-render_operator type="hidden" >
```

- marcatori


### RenderRadioView

- esempio

```javascript
{{{example_render_radio_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_radio_view" target="_blank">provalo online</a>

- template
```html
<div crud-render_element class="checkbox-inline">
    <i crud-class="icon_class" ></i> <span crud-field="text"> </span>
</div>
```

- marcatori


---

## RenderCheckbox
   
   - caption_selector : '[crud-render_caption]' - marcatore 

### RenderCheckboxEdit

- esempio

```javascript
{{{example_render_checkbox_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_checkbox_edit" target="_blank">provalo online</a>

- template
```html
<label crud-render_element class="checkbox-inline">
    <input crud-render_control type="checkbox" value="">  <span crud-render_caption> </span>
</label>
<input crud-render_exists type="hidden" >
```

- marcatori

### RenderCheckboxSearch

- esempio

```javascript
{{{example_render_checkbox_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_checkbox_search" target="_blank">provalo online</a>

- template
```html
<label crud-render_element class="checkbox-inline">
    <input crud-render_control type="checkbox" value="">  <span crud-render_caption> </span>
</label>
<input crud-render_operator type="hidden" >
```

- marcatori


### RenderCheckboxView

- esempio

```javascript
{{{example_render_checkbox_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_checkbox_view" target="_blank">provalo online</a>


- template
```html
<div crud-render_element class="checkbox-inline">
    <i crud-class="icon_class" ></i> <span crud-field="text"> </span>
</div>
```

- marcatori

---

## RenderCaptcha

Questo render incapsula il captca con il suo relativo reload. Esiste solo in modalità edit


### RenderCaptchaEdit

- esempio

```javascript
{{{example_render_captcha_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_captcha_edit" target="_blank">provalo online</a>

- template
```html
<div class="row">
    <div class="col-sm-4" crud-captcha_img  >

    </div>
    <div class="col-sm-4">
            <input crud-render_control="" class="form-control" type="text" name="" value="">
    </div>
    <div class="col-sm-4">
        <button class="btn btn-sm btn-default" type="button" crud-button_reload>Reload</button>
    </div>
</div>
```

- marcatori
- captcha_img_selector : '[crud-captcha_img]'


---


## RenderCustom
  
Oggetto per chi vuole poter modificare l'html da renderizzare. Qui si può inserire 
tutto quello che si vuole utilizzando che chiamate render e finalize. Le tre classi sono
uguali.

### RenderCustomEdit

- esempio

```javascript
{{{example_render_custom_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_custom_edit" target="_blank">provalo online</a>

- template
```html
<div crud-render_element crud-render_control></div>
```

- marcatori

- crud-render_element
- crud-render_control


---



## RenderDecimal

Oggetto per la gestione dei decimali con parte intera e decimale gestiti separatamente.

### RenderDecimalEdit

- esempio

```javascript
{{{example_render_decimal_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_decimal_edit" target="_blank">provalo online</a>

- template
```html
<div class="input-group" crud-render_element>
    <span class="input-group-addon hide symbol_left" crud-render_symbol></span>
    <input class="form-control text-right" type="text" crud-render_control_int>
    <span class="input-group-addon">,</span>
    <input class="form-control text-right" type="text" crud-render_control_dec>
    <input type="hidden" crud-render_control="">
    <span class="input-group-addon hide symbol_right" crud-render_symbol></span>
</div>
```

- marcatori

### RenderDecimalSearch

- esempio

```javascript
{{{example_render_decimal_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_decimal_search" target="_blank">provalo online</a>

- template
```html
<div class="input-group" crud-render_element>
    <span class="input-group-addon hide symbol_left" crud-render_symbol></span>
    <input class="form-control text-right" type="text" crud-render_control_int>
    <span class="input-group-addon">,</span>
    <input class="form-control text-right" type="text" crud-render_control_dec>
    <input type="hidden" crud-render_control="">
    <span class="input-group-addon hide symbol_right" crud-render_symbol></span>
    <input crud-render_operator type="hidden" >
</div>
```

- marcatori


### RenderDecimalView

- esempio

```javascript
{{{example_render_decimal_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_decimal_view" target="_blank">provalo online</a>

- template
```html
<div crud-render_element class="text-right">
    <span class="hide symbol_left" crud-render_symbol></span>
    <span class="text-right" crud-render_control_int></span>
    <span class="hide symbol_right text-left" crud-render_symbol></span>
</div>
```

- marcatori


---


## RenderAutocomplete

Questo render è stato pensato per il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata nel input nascosto.
Esiste solo in modalità edit che si chiama `RenderAutocompleteEdit`


### RenderAutocompleteEdit

- esempio

```javascript
{{{example_render_autocomplete_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_autocomplete_edit" target="_blank">provalo online</a>

- template
```html
<div class="input-group">
    <span style="height:19px" class="input-group-addon" id="basic-addon1" crud-render_autocomplete_view crud-lang="autocomplete-nonselezionato"></span>
    <input crud-render_control type="hidden" name="" value="">
    <div crud-render_element class="autosuggest" crud-minLength="1" crud-queryURL="">
        <input crud-render_autocomplete_input type="text" name="src" placeholder="" class="form-control typeahead" />
    </div>
</div>
```


#### Proprietà
- `routeName` : 'autocomplete' - nome della route da utilizzare per reperire i dati dal server
- `autocomplete_view_selector` : '[crud-render_autocomplete_view]' - marcatore dove verrà visualizzato
le info della entry scelta
- `autocomplete_input_selector` : '[crud-render_autocomplete_input]' - marcatore dove verrà agganciato
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

- esempio

```javascript
{{{example_render_belongsto_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_belongsto_view" target="_blank">provalo online</a>

- marcatori
- crud-render_element


- template
```html
    <div crud-render_element></div>
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
    <span crud-field="cognome"></span> altro campo <span crud-field="nome"></span>
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

- year_selector    : '[crud-render_year]',
- month_selector    : '[crud-render_month]',
- day_selector    : '[crud-render_day]',
- picker_selector : '[crud-render_picker]',
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

- esempio

```javascript
{{{example_render_date_select_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_date_select_edit" target="_blank">provalo online</a>


- marcatori:

- `crud-render_element` : container di tutto il render
- `crud-render_control` : input per la form che conterrà il valore da spedire
- `crud-render_day_container`
- `crud-render_day` : select associata al giorno
- `crud-render_month_container`
- `crud-render_month` : select associata al mese
- `crud-render_year_container`
- `crud-render_year` : select associata all'anno

- template
```html
<div crud-render_element  class="input-group">
    <input crud-render_control="" type="hidden" />
    <div class="input-group-btn" crud-render_day_container>
        <select class="form-control" crud-render_day>
        
        </select>
    </div>
    <div class="input-group-btn" crud-render_month_container>
        <select class="form-control" crud-render_month>
        
        </select>
    </div>
    <div class="input-group-btn" crud-render_year_container>
        <select class="form-control" crud-render_year>
        
        </select>
    </div>
</div>
```

### RenderDateSelectSearch

Estende `RenderDateSelectEdit` ridefinendo al render dove aggiunge il controllo per l'operatore di ricerca
e cambia i nomi per la convenzione con view search

- esempio

```javascript
{{{example_render_date_select_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_select_search" target="_blank">provalo online</a>

### RenderDateSelectView

Estende `DateSelectCommon`  

- esempio

```javascript
{{{example_render_date_select_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_select_view" target="_blank">provalo online</a>

marcatori

- crud-render_element: container dove verrà visualizzata la data

template 
```html
<span crud-render_element></span>
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

- esempio

```javascript
{{{example_render_date_picker_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_picker_edit" target="_blank">provalo online</a>

- template
```html
<div crud-render_element>
    <input crud-render_control="" type="hidden" />
    <div class="input-group">
        <input crud-render_picker class="form-control text-right" autocomplete="off" />
        <a crud-clear class="input-group-addon" href="javascript:void(0)"><span ><i class="fa fa-times"></i></span></a>
    </div>
</div>
```


### RenderDatePickerSearch

- esempio

```javascript
{{{example_render_date_picker_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_picker_search" target="_blank">provalo online</a>

- template
```html
<div crud-render_element>
    <input crud-render_control="" type="hidden" />
    <input crud-render_operator type="hidden" >
    <div class="input-group">
        <input crud-render_picker class="form-control text-right" autocomplete="off" />
        <a crud-clear class="input-group-addon" href="javascript:void(0)"><span ><i class="fa fa-times"></i></span></a>
    </div>
</div>
```


### RenderDatePickerView

- esempio

```javascript
{{{example_render_date_picker_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_picker_view" target="_blank">provalo online</a>



- template

```html
<span crud-render_element></span>
```

## RenderDateFormatted
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker nativo del broswer associato al type=date, se supportato.

### RenderDateFormattedEdit

- esempio

```javascript
{{{example_render_date_formatted_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_formatted_edit" target="_blank">provalo online</a>

- template
```html
<div class="clearfix" crud-render_element>
    <input crud-render_control="" type="hidden" />
    <div class="col col-xs-6">
        <input crud-date_formatted class="form-control" type="date" />
    </div>
    <div class="col col-xs-6">
        <input crud-time_formatted class="form-control hide" type="time"/>
    </div>
</div>
```


### RenderDateFormattedSearch

- esempio

```javascript
{{{example_render_date_formatted_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_formatted_search" target="_blank">provalo online</a>

- template
```html
<div class="clearfix" crud-render_element>
    <input crud-render_control="" type="hidden" />
    <div class="col col-xs-6">
        <input crud-date_formatted class="form-control" type="date" />
    </div>
    <div class="col col-xs-6">
        <input crud-time_formatted class="form-control hide" type="time"/>
    </div>
</div>
```



### RenderDateFormattedView

- esempio

```javascript
{{{example_render_date_formatted_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_date_formatted_view" target="_blank">provalo online</a>

- template
```html
<div class="clearfix" crud-render_element>
    <input crud-render_control="" type="hidden" />
    <div class="col col-xs-6">
        <input crud-date_formatted class="form-control" type="date" />
    </div>
    <div class="col col-xs-6">
        <input crud-time_formatted class="form-control hide" type="time"/>
    </div>
</div>
```


## RenderBetweenDateSelect

Questo render serve per la gestione di un range di date.

### RenderBetweenDateSelectEdit

- esempio

```javascript
{{{example_render_between_date_select_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_select_edit" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```


### RenderBetweenDateSelectSearch

- esempio

```javascript
{{{example_render_between_date_select_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_select_search" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```

### RenderBetweenDateSelectView

- esempio

```javascript
{{{example_render_between_date_select_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_select_view" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```


---

## RenderBetweenDatePicker

Questo render serve per la gestione di un range di date.

### RenderBetweenDatePickerEdit

- esempio

```javascript
{{{example_render_between_date_picker_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_picker_edit" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```

### RenderBetweenDatePickerSearch

- esempio

```javascript
{{{example_render_between_date_picker_search}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_picker_search" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```



### RenderBetweenDatePickerView

- esempio

```javascript
{{{example_render_between_date_picker_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_picker_view" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```



---



## RenderBetweenDateFormatted

Questo render serve per la gestione di un range di date.

### RenderBetweenDateFormattedEdit

- esempio

```javascript
{{{example_render_between_date_formatted_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_formatted_edit" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```



### RenderBetweenDateFormattedSearch

- esempio

```javascript
{{{example_render_between_date_formatted_search}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_formatted_search" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```

### RenderBetweenDateFormattedView

- esempio

```javascript
{{{example_render_between_date_formatted_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_between_date_formatted_view" target="_blank">provalo online</a>

- template

```html
<div>
    <div class="col col-xs-6">
        <div crud-label="app.dal"></div>
        <div crud-render_start></div>
    </div>
    <div class="col col-xs-6" >
        <div crud-label="app.al"></div>
        <div crud-render_end></div>
    </div>
</div>
```



---


## RenderHasmany

Oggetto per la gestione delle relazioni esterne. Permette l'inserimento e visualizzazione
di relazioni esterne in un'unica form. Questo render definisce due template quello dell'hasmany
che e' formato di tanti itemTemplate.


### RenderHasmanyEdit

- esempio

```javascript
{{{example_render_hasmany_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_edit" target="_blank">provalo online</a>

- template
```html
<div class="" crud-render_element >
    <div class="col col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading" crud-hasmany_title></div>
            <div class="panel-body">
                <p crud-hasmany_title_msg></p>
                <ul class="list-unstyled sort_class hasmany-list" crud-render_list >
                    <!--  -- contenitore hasmany -- -->
                </ul>
            </div>
            <div class="panel-footer">
                <div >
                    <div crud-render_limit class="hide">
                        <!-- Limite massimo raggiunto -->
                    </div>
                    <button crud-button_add crud-pk="" type="button" class="btn btn-primary">
                        <span crud-label="app.add"></span>&nbsp;
                        <span crud-label="modelMetadata.singular"></span>&nbsp;
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
```

#### itemTemplate
```html
<li class="col col-lg-6 col-md-6 col-sm-12 col-xs-12" crud-hasmany_item_structure>
    <div class="clearfix" >
        <div class="clearfix" >
            <span class="pull-left button-move">
                <i class="fa fa-arrows"></i>        
            </span>
            <span class="pull-right btn btn-xs btn-danger" crud-button_delete>
                <i class="fa fa-close"></i>        
            </span>
        </div>
        <div class="col col-sm-12" crud-hasmany_item> 
        </div>

    </div>
    <hr />
</li>
```


- marcatori


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

- esempio

```javascript
{{{example_render_hasmany_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_view" target="_blank">provalo online</a>

- template
```html
<div crud-render_element>
    <div class="list-unstyled" crud-render_list >
        <ul class="list-unstyled" crud-field="items" crud-self>
            <!--  -- contenitore lista hasmany -- -->
        </ul>
    </div>
</div>
```
#### itemTemplate 
```html
<li>
    <span crud-field="label" ></span>
</li>
```

- marcatori



---




## RenderHasmanyThrough

Oggetto per la gestione degli hasmany trought...

#### proprietà
- selected : [],
- modelName : "none",
- last_searched_result : null,  // json risultato dell'ultima ricerca
- hasmany_container : '[crud-hasmany_container]',
- selected_container : '[crud-selected_container]',
- title_selector : '[crud-render_title]',
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

- esempio

```javascript
{{{example_render_hasmany_through_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_through_edit" target="_blank">provalo online</a>


#### proprietà
- resources : [ 'jquery-sortable.js']
- _views : [],

#### metodi

- itemExist : function (values) {
- addItem : function (values) {
- deleteItem : function (vkey) {

- template
```html
<div class="" crud-render_element >
    <div class="col col-sm-12" >
        <div class="panel panel-info">
           <div class="panel-heading" crud-render_title>

           </div>
           <div class="panel-body padding-3">

               <div class="col col-md-4 col-sm-12 padding-6 panel panel-default panel-body" >
                   <h5>Elementi selezionati</h5>
                   <ul class="list-unstyled sort_class " crud-selected_container>
                   </ul>

               </div>
                  <div class="col col-md-8 col-sm-12 padding-15" crud-template="searched">

                      

                  </div>
           </div>
        </div>
    </div>
</div>
```

#### itemTemplate
template utilizzato per la visualizzazione degli elementi ricercati
```html
<li crud-item class="col col-md-6 col-sm-12 col-xs-12">
   <div class="fullwidth">
    <span style="pointer:hand" class="btn btn-xs btn-primary" crud-add crud-id crud-label crud-morph_type crud-morph_id crud-attrs="{'crud-id':id,'crud-label':label,'crud-morph_type':morph_type,'crud-morph_id':morph_id}">
        <i class="fa fa-plus"></i>
    </span>
   <span crud-field='label'></span>
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
        <button class="btn btn-default btn-sm" type=button crud-lang="general-search">Go</button>-->
    </span>
    <input class="form-control "  crud-search type="text" value="" crud-placeholder="Inserire parole da ricercare">
    <span crud-button_add class="input-group-addon ">
        <i  class="fa fa-plus"></i>
    </span>
</div>

<div class= style="position:relative; overflow:hidden;">
    <ul class="list-unstyled list-hover list-inline" crud-hasmany_container crud-slimscroll-visible="false" style="overflow: auto; width: auto; min-height: 60px;">
    
    </ul>
</div>
```

#### viewTemplate
template utilizzato per visualizzare la view interna
```html
<div>
    <div crud-view_action></div>
    <div crud-hidden_fields></div>
    <div class="clearfix" >
        <div class="" crud-view_elements></div>
       
    </div>
</div>
```

#### addedItemTemplate
template utilizzato per creare l'elemnto lista dove verrà visualizzata la view interna
```html
<li class="padding-bottom-6 border-bottom-1" crud-hasmany_through_item>
               
</li>
```

- marcatori

- crud-hasmany_through_item


### RenderHasmanyThroughView

Questo è in modalità view con itemTemplate base, in caso di item piu' complessi ridefinire itemTemplate
aggiungendo l'attributo crud-field="nome_campo" nel item html che si voglia usare per visualizzarlo

- esempio

```javascript
{{{example_render_hasmany_through_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_through_view" target="_blank">provalo online</a>


- template
```html
<div crud-render_element>
    <ul class="list-unstyled" crud-render_list crud-field="items" crud-self>
        <!--  -- contenitore lista hasmany data dal template  default_hasmany_view_items_tpl-- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li >
    <span crud-field="__label__"></span>
</li>
```

- marcatori



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
- icon_selector : "[crud-icon_img]",


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

- esempio

```javascript
{{{example_render_hasmany_upload_image_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_upload_image_edit" target="_blank">provalo online</a>


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
        <div crud-custom_html>

        </div>
        <table class="table">
            <tr>
                <td>
                    <div >
                        <span crud-label="app.accepted-extensions"></span>:</div>
                        <div crud-label="app.extensions-foto"></div>
                        <div >Max <span crud-label="app.upload-max-filesize" ></span> 
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <input class="btn btn-default" type="file" name="file">
                    </div>
                </td>
                <td>
                    <div >
                        <div crud-preview crud-field="data"></div>
                    </div>
                </td>
                <td>

                </td>
            </tr>
        </table>
        <div crud-view_container>
    
        </div>
    </form>
```

- template

```html
<div class="" crud-render_element >
   <div class="col col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" crud-upload_title crud-label="modelMetadata.singular">
                <br/>
                <span><small crud-foto-msg></small></span>
            </div>
            <div class="panel-body">
                <ul class="list-group sort_class list-inline" crud-render_list >
                <!--  -- contenitore lista fotos -- -->
                </ul>
                <div>
                    <div crud-render_limit crud-lang="general-max_limit_reached"></div>
                    
                </div>
            </div>
            <div class="panel-footer">
                <div>
                    <button crud-button_add crud-pk="" type="button" class="btn btn-primary">
                        <span crud-label="app.add"></span> <span crud-label="model.foto"></span>
                    </button>
                </div>
            </div>
        </div>
   </div>
</div>
```


#### itemTemplate

```html
<li class="list-unstyled" crud-upload_item>
    <div class="col col-sm-12 thumbnail">
        <div crud-model_fields></div>
        <div class="clearfix">
            <small class="pull-left" crud-field="label" crud-trim="12" crud-attrs="{title:label}"></small>
            <button class="btn-danger btn-xs pull-right" type="button" crud-button_delete crud-pk="" title="Cancella Foto"><i class="fa fa-times-circle"></i></button>

        </div>
        <div crud-preview crud-field="data"></div>
    </div>
</li>
```

#### previewItemTemplate

```html
<img crud-icon class="button-move" src="" crud-attrs="{src:(typeof urls !== 'undefined')?Server.getUrl(urls+'small'):Server.getUrl('/imagecache/small/'+filename)}">
```



- marcatori



### RenderHasmanyUploadImageView

- esempio

```javascript
{{{example_render_hasmany_upload_image_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_upload_image_view" target="_blank">provalo online</a>


- template
```html
<div crud-render_element>
    <ul class="list-unstyled" crud-render_list >
        <!--  -- contenitore lista fotos -- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li>
    <img class="img-circle img-list" src="" crud-attrs="{src:Server.getUrl(urls+'icon')}" />
</li>
```


- marcatori


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
- icon_selector : "[crud-icon]",

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

- esempio

```javascript
{{{example_render_hasmany_upload_attachment_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_upload_attachment_edit" target="_blank">provalo online</a>


#### proprietà

- traits : ['TraitUpload'],
- resources : ['jquery.form.js','jquery-sortable.js'],
      
#### metodi

- _createItem : function (values,status)



- template
```html
<div class="" crud-render_element >
   <div class="col col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" crud-upload_title>
                <br/>
                <span><small crud-foto-msg></small></span>
            </div>
            <div class="panel-body">
                <ul class="list-group sort_class list-inline" crud-render_list >
                <!--  -- contenitore lista fotos -- -->
                </ul>
                <div>
                    <div crud-render_limit crud-lang="general-max_limit_reached"></div>
                    
                </div>
            </div>
            <div class="panel-footer">
                <div>
                    <button crud-button_add crud-pk="" type="button" class="btn btn-primary">
                        <span crud-label="app.add"></span> <span crud-label="model.attachment"></span>
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
    <i crud-icon></i>
</span>
```


#### itemTemplate

```html
<li class="list-unstyled" crud-upload_item>
    <div class="col col-sm-12 thumbnail">
        <div crud-model_fields></div>
        <div class="clearfix">
            <small class="pull-left" crud-field="label" crud-trim="12" crud-attrs="{title:label}"></small>
            <button class="btn-danger btn-xs pull-right" type="button" crud-button_delete crud-pk="" title="Cancella Foto"><i class="fa fa-times-circle"></i></button>

        </div>
        <div crud-preview crud-field="data"></div>
    </div>
</li>
```


#### dialogContentTemplate

```html
    <div id="loader_foto"></div>
    <form enctype="multipart/form-data" method="POST"
        action="" encoding="multipart/form-data"
        name="formupload">
        <div crud-custom_html>

        </div>
        <table class="table">
            <tr>
                <td>
                    <div >
                        <span crud-label="app.accepted-extensions"></span>:</div>
                        <div crud-label="app.extensions-attachment"></div>
                        <div >Max <span crud-label="app.upload-max-filesize" ></span> 
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <input class="btn btn-default" type="file" name="file">
                    </div>
                </td>
                <td>
                    <div >
                        <div crud-preview crud-field="data"></div>
                    </div>
                </td>
                <td>

                </td>
            </tr>
        </table>
        <div crud-view_container>
    
        </div>
    </form>
```

- marcatori


### RenderHasmanyUploadAttachmentView

- esempio

```javascript
{{{example_render_hasmany_upload_attachment_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_upload_attachment_view" target="_blank">provalo online</a>


- template
```html
<div crud-render_element>
    <ul class="list-unstyled" crud-render_list >
        <!--  -- contenitore lista fotos -- -->
    </ul>
</div>
```

#### itemTemplate
```html
<li>
    <a class="small" target="_blank" href="#"
            crud-href="'/downloadfile/'+id" crud-totranslate="true" crud-attrs="{'title':full_filename}" crud-append="true">
                <i crud-class="icon" />
    </a>
</li>
```


- marcatori



---




## RenderMap

Oggetto per la visualizzazione e la selezione di coordinate gps basato su googlemaps

#### proprietà

- _lat : 0,
- _lng : 0,
- _hasDbValues : false,
- address : null,
- lat_input_selector : '[crud-lat_field]',
- lng_input_selector : '[crud-lng_field]',
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

- esempio

```javascript
{{{example_render_map_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_map_edit" target="_blank">provalo online</a>


#### metodi

- ok : function() {
- setValue : function(lat,lng)
- 



- template
```html
<div crud-control_container>
    <button class="btn btn-default" type="button" crud-button_map crud-label="app.modifymap"></button>
    <div class="clearfix">
       
        <span class="pull-left" >
            <span crud-label="app.gpslat"></span>: <input  class="form-control" crud-lat_field></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <span class="pull-left">
            <span crud-label="app.gpslng"></span>: <input class="form-control" class="badge" crud-lng_field></input>
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
                                <span class="input-group-addon" id="basic-addon2"><a crud-lnk_address href="javascript:void(0)"  ><i class="fa fa-search"></i> Cerca indirizzo</a></span>
        
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
                    <div crud-area_container class="row hide">
                        <div class="col col-xs-12" >
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Cerchio di raggio in metri?</span>
                                <input class="form-control" crud-input_raggio type="text" value="1000">
                            </div>
                        </div>
        
        
                        <!-- <span>Lat:</span> <input  type="text" name="lat"> , <span>Lng:</span> <input type="text" name="lng">  -->
                    </div>
                    <div id="gmap" style="width:100%;height:400px"></div>
                </div>
                <div class="modal-footer">
                    <button crud-button="cancel" type="button" class="btn btn-primary"
                            data-dismiss="modal">Annulla</button>
                    <button crud-button="ok" type="button" class="btn btn-primary"
                            data-dismiss="modal">Ok</button>

                </div>
           </div>
```

- marcatori

### RenderMapSearch

- esempio

```javascript
{{{example_render_map_search}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_map_search" target="_blank">provalo online</a>

- template
```html
<div crud-control_container>
    <button class="btn btn-default" type="button" crud-button_map crud-label="app.modifymap"></button>
    <div class="clearfix">
        <input type="hidden" name="" crud-render_operator>
        <span class="pull-left" >
            <span crud-label="app.gpslat"></span>: <input  class="form-control" crud-lat_field></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <span class="pull-left">
            <span crud-label="app.gpslng"></span>: <input class="form-control" class="badge" crud-lng_field></input>
        </span>
    </div>
   
</div>
```

- marcatori


### RenderMapView

- esempio

```javascript
{{{example_render_map_view}}}
```
<a href="http://www.pierpaolociullo.it/example?f=example_render_map_view" target="_blank">provalo online</a>

- template
```html
<div crud-map_container style="width:100%;height:400px"></div>
```

- marcatori




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

- esempio

```javascript
{{{example_render_swap_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_swap_edit" target="_blank">provalo online</a>

- template
```html
<button type="button" class="btn btn-default btn-xs" crud-render_element title="">
    <i crud-icon class=""></i>
</button>
```

- marcatori

### RenderSwapSearch

- esempio

```javascript
{{{example_render_swap_search}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_swap_search" target="_blank">provalo online</a>

- template
```html
    <input crud-render_control type="hidden" class="form-control" name="" value="">
    <input crud-render_operator type="hidden" >
    <button type="button" class="btn btn-default btn-xs" crud-render_element title="">
        <i crud-icon class=""></i>
    </button>
```

- marcatori

### RenderSwapView

- esempio

```javascript
{{{example_render_swap_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_swap_view" target="_blank">provalo online</a>

- template
```html
<i crud-icon crud-render_element class=""></i>
```

- marcatori


---




## RenderTexthtml

rappresentazione ed editing di testo html




### RenderTexthtmlEdit

editor html summernote.

- esempio

```javascript
{{{example_render_texthtml_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_texthtml_edit" target="_blank">provalo online</a>

- height : 200,
      pluginOptions : {},
      _pluginObject : null,



- template
```html
    <textarea crud-render_element crud-render_control class="summernote form-control" crud-summernote-lang="it-IT"></textarea>

```

- marcatori


### RenderTexthtmlView

- esempio

```javascript
{{{example_render_texthtml_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_texthtml_view" target="_blank">provalo online</a>

- template
```html
<div crud-render_element crud-render_control ></div>
```

- marcatori



---



## RenderUploadImage

### RenderUploadImageEdit

- esempio

```javascript
{{{example_render_upload_image_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_upload_image_edit" target="_blank">provalo online</a>

- template
```html

```

- marcatori


### RenderUploadImageView

- esempio

```javascript
{{{example_render_upload_image_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_upload_image_view" target="_blank">provalo online</a>


- template
```html

```

- marcatori



---




## RenderUploadAttachment

### RenderUploadAttachmentEdit

- esempio

```javascript
{{{example_render_upload_attachment_edit}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_upload_attachment_edit" target="_blank">provalo online</a>


- template
```html

```

- marcatori


### RenderUploadAttachmentView

- esempio

```javascript
{{{example_render_upload_attachment_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_upload_attachment_view" target="_blank">provalo online</a>


- template
```html

```

- marcatori

