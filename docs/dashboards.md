#Dashboard

Le dashboard sono composizioni di views. E' il componente dove verrà implementato
il codice per la gestione e le dipendenze tra più viste. 

##Dashboard

Dashboard è la classe principale da cui ereditano tutte le dashboard che andremo
a creare. {{config.extra.name}}


#Dashboards implementate.

La libreria mette a disposizione alcune dashboard di uso comune, possono essere 
ridefinite per le proprie esigenze o create delle nuove.

##- DashboardList
La DashboardList è formata da un solo componente, una ViewList all'interno contornata
da semplice html. Per instanziare una DashboardList basta scrivere il seguente codice:
```javascript
var dash = new ListDashboard({
    modelName : 'test',
    container : '#view_big',
});
dash.show();
```
- `modelName` rappresenta il modello dei dati che vogliamo gestire nella view
- `container` rappresenta il selettore html dove renderizzare i dati.

##- DashboardEdit

La DashboardEdit è formata da un solo componente, una ViewEdit all'interno contornata
da semplice html. 

##- DashboardInsert

La DashboardInsert è formata da un solo componente, una ViewInsert all'interno contornata
da semplice html. 

##- DashboardTab

La DashboardTab è formata da 5 viste che interagiscono tra di loro:

- una ViewSearch: permette di ricercare gli elementi della ViewList. Quando viene
premuto il tasto search la ViewList si aggiorna mostrando i dati filtrati dalla
ViewSearch
- una ViewList: Visualizza i risultati e contiene delle azioni cliccabili su ogni 
record. Le azioni sono delete,edit,view,create.
- una ViewEdit: Viene mostrata quando viene premuto il tasto modifica nella ViewList
e permette la modifica del record
- una ViewInsert: Viene mostrata quando viene premuto il tasto nuovo e permette la
creazione di un nuovo record
- una ViewView:Viene mostrata in una modal quando viene cliccato l'azione vista.



##- Dashboard2Col
