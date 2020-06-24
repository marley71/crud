#crud

Il vettore associativo globale `crud` contiene le configurazioni base di azioni, routes, views, actions, langs,ecc.
E' accedibile esternamente attraverso la costante `crud` o dall'interno delle componenti con this.$crud.
queste configurazioni vengono prese come base e poi effettuato il merge con le varie istanze. Il
risultato viene poi passato al componente per la sua configurazione iniziale. 
Di seguito riportiamo alcune configurazioni iniziali.

####conf configurazioni iniziali delle views predefinite
```javascript
crud.conf.view = {
    primaryKey : 'id',
    routeName : 'view',
    fieldsConfig : {},
    actions : [],
    customActions: {},
    widgetTemplate : 'c-tpl-record2',
}
```
