
Le dashboards sono composizioni di views. In questo componente si inserisce tutta la logica 
di interazioni tra le views che contiene e le loro dipendendenze.

# Dashboard

`Dashboard` è la classe principale da cui ereditano tutte le dashboard che andremo
a creare. Estende la class `Component`

### Proprietà

- `container`       : null - rappresenta il container di destinazione dove disegnare le views
- `className`       : 'Dashboard' - serve per poter definire a runtime la classe in cui ci si trova
- `modelName`       : null - il modello dei dati che vogliamo gestire,
- `viewKeys`        : [] - array delle key associate ad ogni view
- `labelContext`    : null - contesto nel reperimento delle traduzioni delle label

# Dashboards implementate.

La libreria mette a disposizione alcune dashboard di uso comune, possono essere 
ridefinite per le proprie esigenze oppure se ne possono creare delle nuove.

## DashboardList

La DashboardList è formata da una `ViewSearch` collegata ad una `ViewList` contornata
da semplice html. In questo modo si è creata una dashboard che permette la lista
e la ricerca degli elementi della lista e paginazione. 

<a href="http://www.pierpaolociullo.it/example?f=dash_list" target="_blank">Esempio</a>

#### Proprietà

- `searchKey` : chiave che identifica la view che gestisce la search
- `listKey` : chiave che identifica la view che gestisce la lista

#### marcatori

- `crud-view_search` : contentitore dove verrà disegnata la view associata alla search
- `crud-view_list `: contenitore dove verrà disegnata la view associata alla lista

#### template 

```html
<div id="tabContent">
    <div class="collapse in" crud-collapse_list>
        <header id="page-header">
            <div class="panel panel-default">
                <div class="panel-heading">
                      <span class="title elipsis"> 
                        <strong crud-label="modelMetadata.singular"></strong>
                      </span>
                </div>
            </div>
        </header>

        <div class="padding-15">
            <div crud-view_search></div>
            <div crud-view_list></div>
        </div>
    </div>
</div>
```
    
Per instanziare una DashboardList basta scrivere il seguente codice:

```javascript
var dash = new DashboardList({
    modelName : 'test',
    container : '#test_container1',
});
dash.draw();
```
- `modelName` rappresenta il modello dei dati che vogliamo gestire nella view che viene utlizzato
dalle routes delle due view per reperire i dati con cui popolare le viste.
- `container` rappresenta il selettore html dove renderizzare i dati.



## DashboardEdit

La DashboardEdit è formata da un solo componente, una ViewEdit all'interno contornata
da semplice html. 

<a href="http://www.pierpaolociullo.it/example?f=dash_edit" target="_blank">Esempio</a>

#### Proprietà
    - editKey : chiave che identifica la view che gestisce l'edit
   
#### marcatori

- crud-view_edit : contentitore dove verrà disegnata la view associata all'edit


#### template
```html
<div>
    <div class="panel panel-default">
        <div class="panel-heading">
              <span class="title elipsis"> 
                <strong crud-label="modelMetadata.singular"></strong>
              </span>
        </div>
    </div>
    <div crud-view_edit >
                
    </div>
</div>
```



Per instanziarla basta scrivere il seguente codice:
```javascript
var dash = new DashboardEdit({
    modelName : 'test',
    pk : 1,
    container : '#test_container1',
});
dash.draw();
```

- `modelName` rappresenta il modello dei dati che vogliamo gestire nella view che viene utlizzato
dalla route della view per reperire i dati con cui popolare la vista.
- `container` rappresenta il selettore html dove renderizzare i dati.
- `pk` : chiave del record da caricare




## DashboardInsert

La DashboardInsert è formata da un solo componente, una ViewInsert all'interno contornata
da semplice html. 

<a href="http://www.pierpaolociullo.it/example?f=dash_insert" target="_blank">Esempio</a>

- Proprietà
    - insertKey : chiave che identifica la view che gestisce l'insert
   
#### marcatori

- crud-view_insert : contentitore dove verrà disegnata la view associata all'insert

#### template
 
```html
<div>
    <div class="panel panel-default">
        <div class="panel-heading">
              <span class="title elipsis"> 
                <strong crud-label="modelMetadata.singular"></strong>
              </span>
        </div>
    </div>           
    <div crud-view_insert>
                
    </div>
</div>
```

Per instanziarla basta scrivere il seguente codice:
```javascript
var dash = new DashboardInsert({
    modelName : 'test',
    container : '#test_container1',
});
dash.draw();
```
- `modelName` rappresenta il modello dei dati che vogliamo gestire nella view che viene utlizzato
dalla route della view per reperire i dati con cui popolare la vista.
- `container` rappresenta il selettore html dove renderizzare i dati.




## DashboardTab

La DashboardTab è formata da 5 viste che interagiscono tra di loro:

- una `ViewSearch` che permette di ricercare gli elementi della `ViewList`. 
- una `ViewList`: Visualizza i risultati e contiene delle azioni cliccabili su ogni 
record. Le azioni sono delete,edit,view,create.
- una `ViewEdit`: Viene mostrata quando viene premuto il tasto modifica nella ViewList
e permette la modifica del record
- una `ViewInsert`: Viene mostrata quando viene premuto il tasto nuovo e permette la
creazione di un nuovo record
- una `ViewView`:Viene mostrata in una modal quando viene cliccato l'azione vista.

<a href="http://www.pierpaolociullo.it/example?f=dash_tab" target="_blank">Esempio</a>

#### Proprietà
    - insertKey : chiave che identifica la view che gestisce l'insert
    - editKey : chiave che identifica la view che gestisce l'edit
    - searchKey : chiave che identifica la view che gestisce la search
    - listKey : chiave che identifica la view che gestisce la lista

#### Metodi 
    - showEdit : metodo per la visualizzazione di edit
    - showInsert : 
    - showList
    - showDialog 
       
#### marcatori

- `crud-view_search` : contentitore dove verrà disegnata la view associata alla search
- `crud-view_list` : contentitore dove verrà disegnata la view associata alla lista
- `crud-view_insert` : contentitore dove verrà disegnata la view associata all'insert
- `crud-view_edit` : contentitore dove verrà disegnata la view associata all'edit
- `crud-view_view` : contentitore dove verrà disegnata la view associata alla vista




#### template
```html
<div class="tab-content"> 
    <header>
        <div class="panel panel-default">
            <div class="panel-heading">
                  <span class="title elipsis">
                        <strong crud-label="modelMetadata.singular"></strong>
                  </span>
            </div>
        </div>
    </header>
    <div class="collapse in" crud-collapse_list>
        <div class="padding-15">
            <div crud-view_search>
            </div>
            <div crud-view_list>
            </div>
        </div>
    </div>

    <div class="collapse" crud-collapse_edit>
        <div class="padding-15">
            <div crud-view_edit></div>
            <div crud-view_insert></div>
        </div>
    </div>

    <div crud-view_dialog class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" crud-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title" crud-label="modelMetadata.singular" ></h4>
                </div> 
                <div class="modal-body">
                    <div crud-view_view></div>
                </div>
                <div class="modal-footer">
                    <button crud-button="cancel" type="button" class="btn btn-primary "
                          crud-dismiss="modal">Annulla
                    </button>
                    <button crud-button="ok" type="button" class="btn btn-primary"
                            crud-dismiss="modal">Ok
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
```

## Dashboard2Col

La Dashboard2Col è come la DashboardTab ma organizzata su 2 colonne. La ViewView
non viene mostrata in modal
Anche questa dashboar contiene 5 viste :

- una `ViewSearch` che permette di ricercare gli elementi della `ViewList`. 
- una `ViewList`: Visualizza i risultati e contiene delle azioni cliccabili su ogni 
record. Le azioni sono delete,edit,view,create.
- una `ViewEdit`: Viene mostrata quando viene premuto il tasto modifica nella ViewList
e permette la modifica del record
- una `ViewInsert`: Viene mostrata quando viene premuto il tasto nuovo e permette la
creazione di un nuovo record
- una `ViewView`:Viene mostrata quando viene cliccato l'azione vista.

<a href="http://www.pierpaolociullo.it/example?f=dash_2col" target="_blank">Esempio</a>

#### Proprietà
    - insertKey : chiave che identifica la view che gestisce l'insert
    - editKey : chiave che identifica la view che gestisce l'edit
    - searchKey : chiave che identifica la view che gestisce la search
    - listKey : chiave che identifica la view che gestisce la lista

#### Metodi 
    - showEdit : metodo per la visualizzazione di edit
    - showInsert : 
    - showList
    - showDialog 
       
#### marcatori

- `crud-view_search` : contentitore dove verrà disegnata la view associata alla search
- `crud-view_list` : contentitore dove verrà disegnata la view associata alla lista
- `crud-view_insert` : contentitore dove verrà disegnata la view associata all'insert
- `crud-view_edit` : contentitore dove verrà disegnata la view associata all'edit
- `crud-view_view` : contentitore dove verrà disegnata la view associata alla vista


#### template

```html
<div class="tab-content"> 
    <header >
        <div class="panel panel-default">
            <div class="panel-heading">
                  <span class="title elipsis">
                        <strong crud-label="modelMetada.singular"></strong>
                  </span>
            </div>
        </div>
    </header>
    <div>
        <div class="col col-xs-6">
            <div crud-view_search ></div>
            <div crud-view_list></div>
        </div>
        <div class="col col-xs-6">
            <div crud-view_container="edit">
                <h4 crud-edit_title></h4>
                <div crud-view_edit>
                           
                </div>
            </div>
            <div crud-view_container="insert">
                <h4 crud-insert_title></h4>
                <div crud-view_insert ></div>
            </div>
            <div crud-view_container="view">
                <h4 crud-view_title></h4>
                <div crud-view_view></div>
            </div>
        </div>
    </div>
</div>
```