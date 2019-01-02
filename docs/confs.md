# Confs

Le Confs sono nate per creare configurazioni iniziali per le views di uso generale.
Questo permette di avere, con pochissimo codice, la configurazione di default 
della view e modificare solo le proprietà nella singola istanza. 

## Conf

La Classe Conf è stata realizzata per permettere le estensioni e il merge di configurazioni
per ottenere la configurazione finale da passare alla view.
E' stato implementato un metodo statico

Conf.extend(dest,source) : Prese due configurazioni source e dest, la source verrà mergiata con dest
 sovrascrivendo le proprieta e restituita un unica conf.
- param @source : configurazione sorgente
- param @dest : configurazine destinazione che verranno copiate le proprietà di source
- return object nuova configurazione


## Configurazioni definite di default

Nella libreria ci sono già delle configurazioni di uso comune per ogni oggetto vista 
implementato di default.

### CollectionConf 

Configurazione base per le views di tipo collection

```javascript
var CollectionConf = {
    routeName : null,
    viewClass : null,
    actions : [],
    custom_actions : {},
    fields : [],
    fields_config: {},
    pagination : true,
    detail_fields: {},
}
```

### RecordConf

Configurazione base per le view di tipo record

```javascript
var RecordConf = {
    routeName : null,
    viewClass : null,
    actions : [],
    custom_actions : {},
    fields : [],
    fields_config: {},
    dependencies : {},
    fields_template: 'left',  // può essere stringa o array associativo {field : struttura} per definizioni di struttura per ogni campo
}
```


### ConfList 

Rappresenta la configurazione base utilizzare nella creazione di una view di lista di oggetti.

```javascript
var ConfList = Conf.extend(CollectionConf,{
    routeName : 'list',
    viewClass : 'ViewList',
    actions : ['ActionDelete','ActionMultiDelete','ActionEdit','ActionView','ActionInsert'],
    detail_fields : {},
    fields_config: {
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

### ConfEdit

Rappresenta la configurazione per l'editing di un record. 

```javascript
var ConfEdit = Conf.extend(RecordConf, {
    routeName : 'edit',
    viewClass : 'ViewEdit',
    actions : ['ActionSave','ActionBack'],
    custom_actions : {},
    fields: [],
    fields_config: {
        id: {type:'hidden'},
        created_at: {type:'hidden'},
        updated_at: {type:'hidden'},
        deleted_at: {type:'hidden'},
        created_by: {type:'hidden'},
        updated_by: {type:'hidden'},
        activated:  {type: 'radio'},
        descrizione: {type: 'texthtml'},
        body: {type: 'texthtml'},
        note: {type: 'texthtml'},
        fotos: {type: 'hasmany_upload_image',templateName:'no'},
        attachments: {type: 'hasmany_upload_attachment',templateName:'no'},
        data: {type: 'date_picker'},
        status: {type:'hidden'},
        token: {type:'hidden'},
        captcha: {type: 'captcha'},
    },
    dependencies : {}
});
```


### ConfInsert

Rappresenta la configurazione per una vista per inserire un record.

```javascript
var ConfInsert = Conf.extend(ConfEdit,{
    routeName : 'insert',
    viewClass : 'ViewInsert',
});
```

## ConfSearch

Rappresenta la configurazione di una vista per la ricerca.

```javascript
var ConfSearch = Conf.extend(RecordConf ,{
    routeName : 'search',
    viewClass : 'ViewSearch',
    actions : ['ActionSearch','ActionReset'],
});
```

## ConfView

Configurazione per la vista in modalità view di un record

```javascript
var ConfView = Conf.extend(RecordConf ,{
    routeName : 'view',
    viewClass : 'ViewView',
    fields_config: {
        attivo: {type: 'swap'},
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

## ConfCalendar

Configurazione per la vista a calendario di una lista di record.

```javascript
var ConfCalendar =  Conf.extend(CollectionConf ,{
    routeName : 'calendar',
    viewClass : 'ViewCalendar',
    data_inizio : 'data',   // nome campo da utlizzare per prendere la data dell'evento
    data_fine : null,       // eventuale campo che segna la data di fine  dell'evento
    title : null,           // nome campo da utilizzare per la visualizzazione dell'evento
    calendar_options : {}   // opzioni da passare al plugin fullCalendar
});
```
