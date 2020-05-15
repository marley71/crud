# c-component

La classe principale di tutte le componenti grafiche è `c-component`, definisce il comportamento
generale che un componente deve avere nella visualizzazione di un html e della gestione dei dati. Definisce
la proprietà cConf per la configurazione del componente, la carica ed estende l'oggetto con tutte le proprietà
trovate in cConf.

Per convenzione i metodi preceduti da "_" sono da considerarsi privati e non andrebbero mai ridefiniti se non per cambiare
sostanzialmente il comportamento della classe a basso livello.


#### Proprietà

- `cConf` : rappresenta la configurazione iniziale del componente. E' formata da un vettore associativo. Tutte le 
proprietà di cConf vengono spalmate flat nel `data` del componente vue.


#### Metodi

- `jQe(selector)` : shortcut jquery, ritorna l'oggetto jquery associato al container del componente, se viene
passato il parametro *selector* allora si posiziona all'elemento puntato dal selector all'interno
del container.

- `_loadConf()` : Carica l'oggetto cConf e spalma le proprietà nell'oggetto.

- `_getConf` : risolve il nome cConf, cConf può essere un array associativo o una stringa. In caso di stringa ricerca
la configurazione nella window o nella configurazione generale dell'applicazione chiamata crud. Può essere usato il
punto per configurazioni gerarchiche. Esempio potrei creare una configurazione tipo:

```javascript
window.conf1 = {
    paginax : {
        elementoa: {
            var1 :'v1',
            var2 :'v2'
        }   
    }
}
```
posso passare come attributo del componente c-conf="conf1.paginax.elementoa";

- `_getRoute(routeName)` : Crea l'oggetto Route di nome routeName. La definizione della route viene cercata nell'oggetto
$crud.routes[routeName];

- `beforeLoadResources()` : metodo chiamato prima di caricare risorse esterne di particolari plugins di terze parti 
- `afterLoadResources()` : metodo chiamato dopo aver caricato risorse esterne di plugins. Questo permette di eseguire
eventuali azioni del plugins dopo che le risorse siano state caricate.
