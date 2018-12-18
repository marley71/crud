# Confs

Le Confs sono nate per creare configurazioni iniziali per le views di uso generale.
Questo permette di avere, con pochissimo codice, la configurazione di default 
della view e modificare solo le proprietà nella singola istanza e dove occorre. 

## Conf

La Classe Conf è la classe base che ereditano tutte le confs. Il costrutture 
accetta un vettore associativo per la sostituizione di proprietà della configurazione che 
andiamo ad instanziare. 

### Proprietà
- `routeName`: Indica la route da utilizzare per il caricamento dei dati della view. 
Su routeName verrà utilizzata la convenzione del metodo statico 
[Route.factory(routeName)](routes.md) 
- `viewClass`: Indica la classe view da utilizzare. Esempio *ViewList*
- `actions`: Vettore di azioni presenti nella view. La visualizzazione delle actions 
sarà compito della view secondo le sue strategie di visualizzazione.
- `custom_actions`: Vettore di azioni con la loro definizione nel caso in cui 
nel vettore actions  siano indicate azioni custom o azioni che vogliamo ridefinire rispetto 
a quelle di default.
- `fields`: Il Vettore dei campi che deve essere gestito dalla views.
- `pagination`: default true. Valido solo per le liste, indica se vogliamo o no il paginatore
- `fields_confige` : Vettore della definizione del tipo di tutti i campi presenti in *fields* 
con le loro eventuali estensioni.



### Metodi

- `init(attrs)`: attrs rappresenta il vettore associativo per la ridefinizione
di alcune proprietà di confs.
- attrs : function (attrs): metodo per settare delle proprietà, si aspetta un vettore associativo

- Conf.factory(type,attrs): metodo statico per la creazione di una conf.
    - type: tipo di configurazione da istanziare. Ulizzerà la convezione list => ConfList
    - attrs: opzionale, attributi da ridefinire 


## Configurazioni implementate

Nella libreria ci sono già delle configurazioni di uso comune per ogni oggetto vista 
implementato di default.

## ListConfs 

Rappresenta la configurazione base utilizzare nella creazione di una view di lista di oggetti.

```javascript
var ListConfs = Conf.extend({
    routeName : 'list',         //route da utilizzare per il caricamento dei dati
    viewClass : 'ViewList',     //Componente View da utilizzare per la visualizzazione
    actions : ['ActionDelete','ActionMultiDelete','ActionEdit','ActionView','ActionInsert'],
    pagination : true,
    fields_config: {       // alcuni campi che di default hanno questi tipi
        id :            {type:'hidden'},
        created_at:     {type:'hidden'},
        updated_at:     {type:'hidden'},
        deleted_at:     {type:'hidden'},
        created_by:     {type:'hidden'},
        updated_by:     {type:'hidden'},
        descrizione	:   {type:'hidden'},
        activated:      {type: 'swap','mode': 'edit'},
        verified:       {type: 'swap','mode': 'edit'},
        fotos:          {type: 'hasmany_upload_image',limit:1},
        attachments:    {type: 'hasmany_upload_attachment',limit:1},
        data:           {type: 'date_picker'}
    }
});
```

## EditConfs

Rappresenta la configurazione per l'editing di un record. 

```javascript
var EditConfs = Conf.extend({
    routeName : 'edit',
    viewClass : 'ViewEdit',
    actions : ['ActionSave','ActionBack'],
    fields_config: {
        id: {type:'input'},
        created_at: {type:'hidden'},
        updated_at: {type:'hidden'},
        deleted_at: {type:'hidden'},
        created_by: {type:'hidden'},
        updated_by: {type:'hidden'},
        activated:  {type: 'radio'},
        descrizione: {type: 'texthtml'},
        body: {type: 'texthtml'},
        note: {type: 'texthtml'},
        fotos: {type: 'hasmany_upload_image', 'label': 'no'},
        attachments: {type: 'hasmany_upload_attachment', 'label': 'no'},
        data: {type: 'date_picker'},
        data_formatted: {type:'hidden'},
        status: {type:'hidden'},
        token: {type:'hidden'},
        captcha: {type: 'captcha'},
    },
});
```


## InsertConfs

Rappresenta la configurazione per una vista per inserire un record.

```javascript
var InsertConfs = EditConfs.extend({
    routeName : 'insert',
    viewClass : 'ViewInsert',
});
```

## SearchConfs

Rappresenta la configurazione di una vista per la ricerca.

```javascript
var SearchConfs = Conf.extend({
    routeName : 'search',
    viewClass : 'ViewSearch',
    actions : ['ActionSearch','ActionReset'],
});
```

## ViewConfs

Configurazione per la vista in modalità view di un record

```javascript
var ViewConfs = Conf.extend({
    viewClass : 'ViewView',
    fields_config: {
        attivo: {type: 'swap',mode : 'view'},
        fotos : {type: 'hasmany_upload_image'},
        attachments: {type: 'hasmany_upload_attachment'},
        id: {type:'hidden'},
        created_at: {type:'hidden'},
        updated_at: {type:'hidden'},
        deleted_at: {type:'hidden'},
        created_by: {type:'hidden'},
        updated_by: {type:'hidden'}
    }
});
```

## CalendarConfs

Configurazione per la vista a calendario di una lista di record.

```javascript
var ConfCalendar = CollectionConf.extend({
    routeName : 'calendar',
    viewClass : 'ViewCalendar',
    data_inizio : 'data',       // nome campo da utlizzare per prendere la data dell'evento
    data_fine : null,           // eventuale campo che segna la data di fine  dell'evento
    title : null,               // nome campo da utilizzare per la visualizzazione dell'evento
    calendar_options : {        // opzioni da passare al plugin fullCalendar

    }
});
```



