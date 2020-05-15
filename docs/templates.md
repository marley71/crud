# Template

Il componente `template` è formato dal da un template html per la visualizzazione di un widget,
all'interno di una view. Questo ci permette,volendo, di avere strutture diverse per ogni singolo widget. 
In questo modo possiamo coprire tutte le esigenze di layout della nostra applicazione e render meno statiche
le views. Ogni view ha di default il suo template, possiamo modifcarlo per tutti o per solo per alcuni widget.


##tpl-record
componente per la visualizzazione semplice di un widget all'interno di una view record

####template
```html
<div>
    <label>{{cWidget.label | translate}}</label>
    <v-widget :c-widget="cWidget"></v-widget>
</div>
```

##tpl-record2
componente per la visualizzazione semplice di un widget all'interno di una view record a due colonne

####template
```html
<div class="row">
    <div class="col col-sm-6">{{cWidget.label | translate}}</div>
    <div class="col col-sm-6">
        <v-widget :c-widget="cWidget"></v-widget>
    </div>
</div>
```

##tpl-list
componente per la visualizzazione semplice di un widget all'interno di una view list

####template
```html
<v-widget :c-widget="cWidget"></v-widget>
```

##tpl-no
componente per la visualizzazione di un widget senza template

####template
```html
<v-widget :c-widget="cWidget"></v-widget>
```
