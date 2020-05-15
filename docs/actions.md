# Actions

Le actions sono dei componenti che agiscono su delle view. Attraverso le azioni possiamo agire sulle view. Esempi
standard di azioni sono la save, insert, stampa, ecc.

##action-base
Classe principale delle azioni. Estende la classe principale `c-component` Le azioni rappresentano l'aggancio per le interazioni con 
l'utente sulle views, dashboard oppure semplici bottoni html. Da questa classe
sono state definite altri due azioni generali la `RecordAction` e la `CollectionAction` che
fondamentalmente dividono il comportamento in azioni che agiscono sul singolo record
e azioni che agiscono su una collezione di record.

####data

- `type` : default collection può essere `record` o `collection`
- `controlType` : default 'button',
- `text` : '',
- `icon` : '',
- `css` : 'btn btn-outline-secondary',
- `target` : '',
- `href` : '',
- `enabled` : true,
- `visible` : true,
- `title` : '',
- `view` : default this.$parent


####Metodi

- `_beforeExecute(callback)` : metodo chiamato quando l'azione viene cliccata, prima di essere eseguita
- `_execute` : esecuzione dell'azione 
- `_afterExecute` : metodo chiamato dopo che l'azione è stata eseguita.
- `setEnabled(enable)` : abilita o disablita l'azione
- `setVisible(visible)` : se definita viene chiamata al termi dell'execute

    

# Actions Implementate

La libreria, come per tutti gli altri componenti, mette a disposizione delle azioni già predefinite, 
utilizzabili immediamente. Queste azioni rappresentano le azioni più comuni in una libreria crud. Ovviamente
possono essere estese o definite delle nuove. Le configurazioni di tale azioni le potete trovare sotto
crud.recordActions e crud.collectionActions. Potete ridefinire qui le varie opzioni grafiche o del metodo
execute.

##action-edit
Azione di tipo record pensata per l'utilizzo dentro una view list e rappresenta l'edit di un record 
all'interno della lista. 

####data

- `type` : 'record'
- `title` : 'app.modifica',
- `icon` : 'fa fa-edit',
- `css` : 'btn btn-outline-secondary btn-sm'
- `modelName` : nome modello dati della view,
- `modelData` : l'intera record del modello dati

####Metodi 

- `execute` - carica una pagina con url "/edit/" + this.modelName + "/" + this.modelData[this.view.primaryKey];


##action-insert
Azione di tipo  `collection`. Azione pensata per l'utilizzo dentro una view list  per l'inserimento di un record all'interno della lista.

####data

- `title` : 'Inserisci',
- `icon` : 'fa fa-plus text-success',
- `css` : 'btn btn-default btn-xs text-success',
- `text` : 'Nuovo',
     
####metodi

- `execute` - utilizza al route per una pagina in insert per richiamare la pagina nuova

##action-save

Azione di tipo record pensata per l'utilizzo dentro una view edit per salvare le modifiche

- `title` : 'Salva',
- `text` : 'Salva',
- `multiText` : 'Salva',

- `execute` - utilizza le route update o save a seconda se il modello dati è in modifica o insert


##action-back

Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view edit ritorna alla pagina di provienienza

- `title` : 'Indietro',
- `text` : 'Torna indietro',

- `execute` esegue sostanzialmente un history.back();


##action-view
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la visualizzazione di un record all'interno della lista.

### data

- `title` :'Visualizza',
- `icon`:  'fa fa-list-alt',
- `multiText` : 'Visualizza',
- `routeName` : 'page_view',
     
### Metodi

- `execute` - utilizza al route per una pagina in view per richiamare la pagina nuova


##action-delete
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di un record all'interno della lista.

### data

- `title` : 'Cancella',
- `icon`:  'fa fa-remove text-danger',
- `multiText` : 'Cancella',
     
### Metodi

- `execute` - utilizza al route delete per eseguire la richiesta di cancellazione. Prima chiede conferma



##action-delete-selected
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di tutti i record selezionati nella lista.

### data

- `className` : 'ActionMultiDelete',
- `title` : 'Cancella selezionati',
- `icon`:  'fa fa-trash text-danger',
- `cssClass` : 'btn btn-default btn-xs text-danger',
- `text` : 'Selezionati',
- `needSelection` : true,     


##action-search
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view search  per la ricerca dei record con i filtri della view.

### data

- `className` : 'ActionSearch',
- `title` : 'Ricerca',
- `icon`:  'fa fa-search',
- `cssClass` : 'btn btn-xs btn-default text-info',
- `text` : 'Cerca',
     
### Metodi

- `execute` - richiama la pagina con i parametri in get presenti nella form della vista


##action-order

##action-edit-mode

##action-view-mode

##action-save-row
