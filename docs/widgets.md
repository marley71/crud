# Widgets

L'insieme dei `Widgets` estendono la componente `c-component` e rappresentano le classe per la gestione di un 
singolo dato. Le componenti widgets possono essere utilizzati in maniera diretta, ma il loro utilizzo reale è 
come componente dei singoli dati di una view. Tutte le proprietà devono essere passate attraverso un vettore associativo.
che rappresenta la cConf del componente. La definizione dei templates si trovano tutti nel 
file `crud-vue.html` 

##w-base 
E' stato creato il component widget base chiamato wBase che deve essere considerata come una specie di classe 
astratta che tutti i widgets estendono e definisce alcuni metodi di uso generale e che quindi come la classe che 
definisce l'interfaccia base dei vari oggetti Widget concreti. Non dovrebbe mai essere istanziata. La sua 
definizione è in `crud.components.wBase`

#### data

- `name` : null - nome dell'oggetto widget (il campo del modello dati che vogliamo gestire)
- `value` : null - valore oggetto
- `resources` : [] - eventuale vettore risorse da caricare per il funzionamento del componente

#### Metodi

- `getFieldName()` - ritorna il nome del campo da attribuire al controllo html di default ritorna la proprietà name. 
- `getValue()` - ritorna il valore del widget, default ritorna la proprietà value
- `setValue(value)` - metodo per settare il valore del widget
- `change()` : metodo chiamato quando il widget cambia valore.

# Widgets Implementati nel framework

La libreria mette a disposizione dei widgets standard per gli usi più comuni, in modo da avere già una base 
abbastanza completa per iniziare a creare le nostre applicazioni. Questi widgets possono essere ridefiniti e/o 
creati di nuovi. Questo ci permette di cambiare, nella nostra applicazione, aspetto e/o funzionalità. 

---

## w-input
Componente per la gestione degli input standard html. La sua definizione è in `crud.components.widgets.wInput`
La definizione del template è nel container con id `w-input-template`

####data
- `inputType` : rappresenta il type del controllo input html. Può essere tutti quelli accettati dal type input html

####template
```html
{{{w-input-template}}}
```

```javascript
{{{example_render_input_edit}}}
```
<a href="http://www.pierpaolociullo.it/example?f=example_render_input_edit" target="_blank">Provalo online</a>

---

##w-hidden
Componente per la gestione di input di tipo hidden, è stato creato un tipo apposta per avere una gestione separata
degli hidden

####template
```html
{{{w-hidden-template}}}
```


## w-text
Componente per la visualizzazione di un testo. La sua definizione è in `crud.components.widgets.wText`
La definizione del template è nel container con id  `w-text-template`

####template
```html
{{{w-text-template}}}
```

- esempio

```javascript
{{{example_render_text_view}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_text_view" target="_blank">provalo online</a>


---

## w-textarea
Componente per la gestione di una textarea. La sua definizione è in `crud.components.widgets.wTextarea`
La definizione del template è nel container con id `w-textarea-template`


####template
```html
{{{w-textarea-template}}}
```

---

## w-select

Componente per la gestione di una select html
La definizione del template è nel container con id `w-select-template`

####data
- `domainValues` : vettore associativo key => valore che rappresenta tutti i possibili valori della select
- `domainValueOrder` : array, facoltativo,eventuale ordinamento dei domainValues.

####template
```html
{{{w-select-template}}}
```

---

## w-input-helped

Questo Render permette di aggiungere ad un input una serie di valori predefiniti che aiutano l'utilizzatore.
La sua definizione è in `crud.components.widgets.wInputHelped`.
La definizione del template è nel container con id `w-input-helped-template`

####data

- `customValue` : true, indica se può essere inserito un valore fuori dal range dei valori predefiniti
- `domainValues` : vettore associativo key => valore che rappresenta tutti i possibili valori che possono essere scelti
- `domainValueOrder` : array, facoltativo,eventuale ordinamento dei domainValues.


####template
```html
{{{w-input-helped-template}}}
```

---

## w-radio

Componente per la gestione di radiobutton html.La sua definizione è in `crud.components.widgets.wRadio`
La definizione del template è nel container con id `w-radio-template`

####data
- `domainValues` : vettore associativo key => valore che rappresenta tutti i possibili valori della select
- `domainValueOrder` : array, facoltativo,eventuale ordinamento dei domainValues.

####template
```html
{{{w-radio-template}}}
```

---

## w-checkbox
   
Componente per la gestione di checkbox html.La sua definizione è in `crud.components.widgets.wCheckbox`
La definizione del template è nel container con id `w-checkbox-template`

####data
- `domainValues` : vettore associativo key => valore che rappresenta tutti i possibili valori della select
- `domainValueOrder` : array, facoltativo,eventuale ordinamento dei domainValues.

####template
```html
{{{w-checkbox-template}}}
```

---

## w-custom
Oggetto per chi vuole poter modificare l'html da renderizzare. 
La sua definizione è in `crud.components.widgets.wCustom`
La definizione del template è nel container con id `w-custom-template`


####template
```html
{{{w-custom-template}}}
```

---


## w-autocomplete

Questo render è stato pensato per il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata in un input nascosto.
Il plugin utilizzato è quello di jquery-autocomplete.
La sua definizione è in `crud.components.widgets.wAutocomplete`
La definizione del template è nel container con id `w-autocomplete-template`

#### data
- `routeName` : 'autocomplete' - nome della route da utilizzare per reperire i dati dal server
- `resources` : '[
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css',
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js'           
                 ]
- `primaryKey` : 'id' - nome campo da salvare nel campo nascosto.
- `fields` : [], vettore dei campi da visualizzare nella tendina degli elementi trovati
- `modelName` : 'nome modello dati da passare alla route'


#### Metodi

- `afterLoadResources()` : Questo metodo viene chiamato in automatico e viene utilizzato per
instanziare il plugin.
- `setRouteValues` : metodo per settare i parametri della route. In caso di route personalizzata, usare
questo metodo per instanziarla e inserire i parametri giusti.
- `clear` : metodo per cancellare eventuale valore selezionato.
- `_getLabel` : politica per il riempimento della label che visualizza l'elemento scelto
- `_getSuggestion` : metodo per il riempimento dei valori trovati mostrati dal widget

####template
```html
{{{w-autocomplete-template}}}
```

---

## w-belongsto

Questo widget è solo per la visualizzazione di dati più complessi che non sono formati da un solo
valore, ma da un vettore associativo. In genere viene utilizzato per la rappresentazione dei 
campi di una relazione esterna belongsto
La sua definizione è in `crud.components.widgets.wBelongsto`
La definizione del template è nel container con id `w-belongsto-template`

#### data
- labelFields: [], vettore nomi dei campi da visualizzare


####template
```html
{{{w-belongsto-template}}}
```

---

## w-date-select

Questo widget è per l'inserimento di una data. Questo widget utilizza tre componenti w-select per 
l'inserimento di una data. Il valore viene salvato in un input nascosto nel formato yyyy-mm-dd;
Usa moment per il controllo di validità della data.
La sua definizione è in `crud.components.widgets.wDateSelect`
La definizione del template è nel container con id `w-date-select-template`

#### data

- minYear    : null, anno minimo se non settatto viene preso l'anno corrente - 5 ,
- maxYear    : null, anno massimo se non settato viene preso l'anno corrente + 5,
- resources :[
    'moment-with-locales.min.js',
]

#### Metodi

- _updateSelect : function () - 
- _getValidDate : function () - 
- _dayValues : function () 
- _monthValues : function () 
- _yearValues : function ()

#### Computed 

- cDay : crea la configurazione iniziale per la select giorni
- cMonth : crea la configurazione iniziale per la select mesi
- cYear : crea la configurazione iniziale per la select anni

####template
```html
{{{w-date-select-template}}}
```

---

## w-date-picker
Questo widget è per l'inserimento di una data. Utilizza il picker bootstrap per 
l'inserimento di una data.
La sua definizione è in `crud.components.widgets.wDatePicker`
La definizione del template è nel container con id `w-date-picker-template`

####data
- displayFormat : Modalità visualizzazione data nel picker, default dd/mm/yyyy
- dateFormat : formato di salvataggio della data nel campo nascosto, default uguale a displayFormat


```javascript
resources : [
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js'
]
```

####template
```html
{{{w-date-picker-template}}}
```

---

## w-hasmany

Componente per la gestione di dati da salvare in una relazione esterna di tipo hasmany 
in un'unica form. Contiene all'interno una lista di v-hasmany.
La sua definizione è in `crud.components.widgets.wHasmany`
La definizione del template è nel container con id `w-hasmany-template`

#### data

- resources : ['jquery-sortable.js']
- confViews : [], vettore configurazione delle views v-hasmany interne
- hasmanyConf : configurazione della view v-hasmany, uguale ad una normale conf di una view ma non 
    sono considerate le azioni.
- limit : default 100, limite massimo del numero di record hasmany

    
    
#### metodi

- getHasmanyConf(index,value),
- addItem() 
- deleteItem(index) 
- showItem(index)
- outOfLimit()
       
####template
```html
{{{w-hasmany-template}}}
```
---

### w-hasmany-view

Componente per la visualizzazione di dati in una relazione esterna di tipo hasmany 
La sua definizione è in `crud.components.widgets.wHasmanyView`
La definizione del template è nel container con id `w-hasmany-view-template`

####template
```html
{{{w-hasmany-view-template}}}
```

---


## wHasmanyThrough

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


#### proprietà
- resources : [ 'jquery-sortable.js']
- _views : [],

#### metodi

- itemExist : function (values) {
- addItem : function (values) {
- deleteItem : function (vkey) {


## w-upload-ajax
DAFINIRE
Componente per la gestione di un upload in modalità ajax. Il componente fa' una chiamata ajax
dove invia il file da uploare e poi salva in un campo nascosto il risultato. Insieme al risultato
ci  mette anche un  anteprima utilizzando il componente r-preview.
La sua definizione è in `crud.components.widgets.wUploadAjax
La definizione del template è nel container con id `w-upload-ajax-template`

#### data 

- extensions : [] estensioni del file accettate,
- maxFileSize : '' dimensione massimo del file da uploadare,
- routeName : 'uploadfile',
- previewConf : configurazione del componente r-preview. Gestione interna,
- error : presenza di errori durante l'upload,
- errorMessage : messaggio di errore dell'upload,
- ajaxFields : vettore associativo di eventuali campi nascosti da mandare in ajax insieme al file,
- lastUpload : contiene la risposta json dell'ultima chiamata ajax.

#### metodi
- setRouteValues(route) : metodo per configurare i parametri della route
- _getFileValue():ritorna il valore del controllo file
- _validate() : eventuali controlli personali di validazione da parte javascript
- validate() : metodo chiamato prima di spedire il file ajax
- sendAjax() : metodo per la chiamata ajax.
- _setUploadFieldsType : function () {
- _setFieldsType : function () {


####template
```html
{{{w-upload-ajax-template}}}
```

---





## w-upload
DAFINIRE
Componente per la gestione di un upload nella form
La sua definizione è in `crud.components.widgets.wUpload
La definizione del template è nel container con id `w-upload-template`

#### proprietà

- extensions : [] estensioni del file accettate,
- maxFileSize : '' dimensione massimo del file da uploadare,

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


####template
```html
{{{w-upload-template}}}
```


---


### w-preview
DAFINIRE
- esempio

```javascript
{{{example_render_hasmany_upload_image_view}}}
```


<a href="http://www.pierpaolociullo.it/example?f=example_render_hasmany_upload_image_view" target="_blank">provalo online</a>


####template
```html
{{{w-preview-template}}}
```

---


## w-swap
DAFINIRE
Componente per eseguire uno swap di valore di un determinato campo attraverso una chiamata ajax.
La sua definizione è in `crud.components.widgets.wSwap
La definizione del template è nel container con id `w-swap-template`

#### data
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


<a href="http://www.pierpaolociullo.it/example?f=example_render_swap_edit" target="_blank">provalo online</a>

####template
```html
{{{w-swap-template}}}
```

---




## w-texthtml
DAFINIRE
rappresentazione ed editing di testo html

editor html summernote.

- esempio

```javascript
{{{example_render_texthtml_edit}}}
```

<a href="http://www.pierpaolociullo.it/example?f=example_render_texthtml_edit" target="_blank">provalo online</a>

- height : 200,
      pluginOptions : {},
      _pluginObject : null,


####template
```html
{{{w-texthtml-template}}}
```

---


##w-b2-select2
DAFINIRE

####template
```html
{{{w-b2-select2-template}}}
```

##w-b2m-select2
DAFINIRE

####template
```html
{{{w-b2m-select2-template}}}
```
