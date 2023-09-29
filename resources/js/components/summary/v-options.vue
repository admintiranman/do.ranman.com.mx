<template>
    <div class="v-opt">
        <p class="subtitle">
            Opciones de Respuesta
            <button type="button" @click="addElement" class="button is-small is-link">
                <i class="fa fa-plus"></i>
            </button>
        </p>
        <div v-for="(o, index) in options" :key="index" class="columns">                                    
            <div class="column is-three-fifths">                
                    <label class="label" for="">Texto</label>
                    <input type="text" name="option[]" class="input" v-model="o.txt" />                 
            </div>
            <div class="column">                
                    <label class="label" for="">Color</label>
                    <input type="color" name="color[]" v-model="o.color" class="input" />                                              
            </div>
            <div class="column">            
                <label class="label" for="">Valor</label>
                <input class="input" type="number" name="value[]" v-model="o.value"  />                  
            </div>
            <div class="column" >
                <label for="" class="label">&nbsp;</label>
                <button @click="() => removeElement(o.id)" v-if="index != 0" type="button" class="button is-danger">
                    <b-icon icon="delete"></b-icon>
                </button>
            </div>
        </div>
    </div>
</template>
<script>


const opt_predeterminadas = [
    {
        id: 0,
        txt: 'No lo hace',
        color: '#FF9966', 
        value: 1
    }, 
    {
        id: 1, 
        txt: 'Pocas veces lo hace',
        color: '#FFD966',
        value: 2
    }, 
    {
        id: 2,
        txt: 'Casi siempre lo hace',
        color: '#2F75B5',
        value: 3         
    },
    {
        id: 3,
        txt: 'Siempre lo hace', 
        color: '#92D050',
        value: 4
    }
];
export default {
    methods: {
        addElement() {
            let id = this.options.reduce((a,b) => a - b);
            let value = 0;
            let color = "#FFFFFF";
            this.options.push({ id, value, color, txt:''});
        },
        removeElement(index) {
            this.options = this.options.filter(f => f.id != index);
        }
    },  
    data() {
        return {
            options: opt_predeterminadas.slice(), 
        }
    }
}
</script>

<style>
    .v-opt {
        margin-bottom: 0.75rem;

    }
</style>