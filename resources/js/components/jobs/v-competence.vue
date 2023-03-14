<template>
    <div>
        <div class="columns">
            <div class="column">                       
                <div class="field">
                    <label for="" class="label">
                        Agregar competencia cultural
                    </label>         
                    <b-autocomplete :confirm-keys="confirm_keys" :data="competencias_core_filter" v-model="competencia_core"  @select="select_competencia_core"  keep-first clear-on-select> 
                    </b-autocomplete>
                </div>                                    
            </div>
            <div class="column">                
                <div class="field">
                    <label for="" class="label">
                        Agregar Competencia del puesto
                    </label>
                    <b-autocomplete :confirm-keys="confirm_keys" :data="competencias_del_puesto_filter" v-model="competencia_del_puesto" @select="select_competencia_del_puesto" keep-first  clear-on-select> 
                    </b-autocomplete>                    
                </div>
            </div>   
            <div class="column">
                <div class="field">
                    <label for="" class="label">
                        Agregar conocimiento  
                    </label>
                    <b-autocomplete :confirm-keys="confirm_keys" :data="conocimientos_filter" v-model="conocimiento" @select="select_conocimiento"  keep-first clear-on-select > 
                    </b-autocomplete>                    
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <label for="" class="label">
                        Agregar experiencia  
                    </label>
                    <b-autocomplete :confirm-keys="confirm_keys" :data="experiencia_filter" v-model="experiencia" @select="select_experiencia"  keep-first clear-on-select > 
                    </b-autocomplete>                    
                </div>
            </div>
        </div>        
        
        <v-table :v_data="array_data" :v_size_page="5">
            <b-table-column v-slot="props" label="Competencias culturales" sortable field="core">
                {{props.row.core}}
                <span @click="() => delete_attr(props.row.core, 'core')" v-if="props.row.core" class="has-text-danger is-clickable">Eliminar</span>
            </b-table-column>
            <b-table-column v-slot="props" label="Competencias del puesto">
                {{props.row.puesto}}
                <span @click="() => delete_attr(props.row.puesto, 'job')" v-if="props.row.puesto" class="has-text-danger is-clickable">Eliminar</span>                
            </b-table-column>
            <b-table-column  label="Conocimientos" v-slot="props">                 
                {{props.row.conocimiento}}
                <span @click="() => delete_attr(props.row.conocimiento, 'knowledge')"  v-if="props.row.conocimiento" class="has-text-danger is-clickable">Eliminar</span>
            </b-table-column>   
            <b-table-column label="Experiencias" v-slot="props">
                {{props.row.experiencia}}
                <span @click="() => delete_attr(props.row.experiencia, 'experiencia')"  v-if="props.row.experiencia" class="has-text-danger is-clickable">Eliminar</span>
            </b-table-column>
        </v-table>
    </div>
</template>
<script>
import axios from "axios";
export default {    
    props: [
        'url_core', 
        'url_job', 
        'url_knowledge', 
        'url_experience',
        'v_data_core', 
        'v_data_job', 
        'v_data_knowledge', 
        'v_data_experiencias', 
        'array_core',
        'array_knowledge',
        'array_job',
        'array_experiences'

    ],        
    methods: {
        delete_attr(txt, key) {
            let url = '';
            switch(key) {

                case 'core':
                    url = this.url_core;                    
                break;
                case 'job':
                    url = this.url_job;
                break;
                case 'knowledge': 
                    url = this.url_knowledge;
                break;
                case 'experiencia':
                    url = this.url_experience;
                break;
            }
            url = url.replace('add' , 'delete');
            console.log(url);
            axios.put(url, {name: txt})
            .then(() => {
                switch(key) {
                    case 'core':                        
                        this.data_core = this.data_core.filter(f => f.name != txt )                    
                    break;
                    case 'job':
                        this.data_job = this.data_job.filter(f => f.name != txt )
                    break;
                    case 'knowledge':
                        this.data_knowledge = this.data_knowledge.filter(f => f.name != txt)
                    break;
                    case 'experiencia':
                        console.log("Experience data delete => ",txt);
                        this.data_experiencias = this.data_experiencias.filter(f => f.name != txt)
                    break;                                
                }
                this.$buefy.toast.open({
                    message: 'Atributo Eliminado Correctamente', 
                    type: 'is-link', 
                    duration: 2500, 
                    position: 'is-bottom-right'                    
                })
            })                      
        },
        select_competencia_core(option)
        {            
            if(option != null){                
                this.competencia_core = '';                
                if(this.array_competecias_core.findIndex(f => f == option) < 0){                    
                    this.array_competecias_core.push(option);
                }
                axios.post(this.url_core, {csrf: this.csrf, name: option })
                .then(() => {
                    this.data_core.push({name: option});
                    this.$buefy.toast.open({
                        message: 'Atributo Agregado Correctamente.', 
                        duration: 2500,
                        type: 'is-link',
                        position: 'is-bottom-right'
                    })                    
                })
                .catch(() => this.$buefy.toast.open({
                    message: 'Ocurrió un error', 
                    type: 'is-danger', 
                    duration: 2500, 
                    position: 'is-bottom-right'
                }))                                               
            }                        
        },
        select_competencia_del_puesto(option) {
            if(option){
                this.competencia_del_puesto = '';
                if(this.array_competecias_del_puesto.findIndex(f => f == option) < 0){
                    this.array_competecias_del_puesto.push(option);
                }
                axios.post(this.url_job, {csrf: this.csrf, name: option})
                .then(() => {
                    this.data_job.push({name: option})
                    this.$buefy.toast.open({
                        message: 'Atributo Agregado Correctamente.', 
                        duration: 2500,
                        type: 'is-link',
                        position: 'is-bottom-right'
                    })                    
                })
                .catch(() => this.$buefy.toast.open({
                    message: 'Ocurrió un error', 
                    type: 'is-danger', 
                    duration: 2500, 
                    position: 'is-bottom-right'
                }))
            }
        },
        select_conocimiento(option) {
            if(option){
                this.conocimiento = '';                
                if(this.array_conocimientos.findIndex(f => f == option) < 0){
                    this.array_conocimientos.push(option);
                }
                axios.post(this.url_knowledge, {csrf: this.csrf, name: option})
                .then(() => {
                    this.data_knowledge.push({name: option})
                    this.$buefy.toast.open({
                        message: 'Atributo Agregado Correctamente.', 
                        duration: 2500,
                        type: 'is-link',
                        position: 'is-bottom-right'
                    })
                })
                .catch(() => this.$buefy.toast.open({
                    message: 'Ocurrió un error', 
                    type: 'is-danger', 
                    duration: 2500, 
                    position: 'is-bottom-right'
                }))
            }
        },

        select_experiencia(option) {
            if(option){
                this.experiencia = '';                
                if(this.array_experiencias.findIndex(f => f == option) < 0){
                    this.array_experiencias.push(option);
                }
                axios.post(this.url_experience, {csrf: this.csrf, name: option})
                .then(() => {
                    this.data_experiencias.push({name: option})
                    this.$buefy.toast.open({
                        message: 'Atributo Agregado Correctamente.', 
                        duration: 2500,
                        type: 'is-link',
                        position: 'is-bottom-right'
                    })
                })
                .catch(() => this.$buefy.toast.open({
                    message: 'Ocurrió un error', 
                    type: 'is-danger', 
                    duration: 2500, 
                    position: 'is-bottom-right'
                }))
            }
        }

    },
    computed:{
        array_data() {            
            let n_core = this.data_core.length;
            let n_puesto = this.data_job.length;
            let n_conocimiento =  this.data_knowledge.length;
            let n_experiencia = this.data_experiencias.length; 
            let n = [n_core, n_puesto, n_conocimiento, n_experiencia].reduce((a,b) => a > b ? a : b);            
            let data = [];

            for(let i = 0; i < n; i++) {
                let aux = {};   
                aux = {...aux, ['core']: n_core > i ? this.data_core[i].name : ''}
                aux = {...aux, ['puesto']: n_puesto > i ? this.data_job[i].name : ''}                
                aux = {...aux, ['conocimiento']: n_conocimiento > i ? this.data_knowledge[i].name : ''}
                aux = {...aux, ['experiencia']: n_experiencia > i ? this.data_experiencias[i].name : ''}
                data.push(aux);                              
            }            
            return data;                                                
        },
        competencias_core_filter(){
            let data = [this.competencia_core];            
            data  = data.concat(this.array_competecias_core.filter(f => f.toString().toLowerCase().indexOf(this.competencia_core.toLowerCase()) >= 0).sort());
            return [... new Set(data)]            
        },
        competencias_del_puesto_filter() {
            let data = [this.competencia_del_puesto];
            data = data.concat(this.array_competecias_del_puesto.filter(f => f.toString().toLowerCase().indexOf(this.competencia_del_puesto.toLowerCase()) >= 0).sort());
            return [... new Set(data)]
            
        },
        conocimientos_filter() {
            let data = [this.conocimiento]; 
            data = data.concat(this.array_conocimientos.filter(f => f.toString().toLowerCase().indexOf(this.conocimiento.toLowerCase()) >= 0).sort());
            return [... new Set(data)]            
        },
        experiencia_filter() {
            let data = [this.experiencia]; 
            data = data.concat(this.array_experiencias.filter(f => f.toString().toLowerCase().indexOf(this.experiencia.toLowerCase()) >= 0).sort());
            return [... new Set(data)]
        }
    },
    data(){    
        return {
            data_core: this.v_data_core,
            data_job: this.v_data_job,
            data_knowledge: this.v_data_knowledge,
            data_experiencias: this.v_data_experiencias,

            confirm_keys: ['Enter'],
            array_competecias_core: this.array_core,
            array_competecias_del_puesto: this.array_job, 
            array_conocimientos: this.array_knowledge,
            array_experiencias: this.array_experiences,
            competencia_core:'', 
            competencia_del_puesto:'',
            conocimiento: '',            
            experiencia: '',
            data: this.v_data
        }
    }
}
</script>