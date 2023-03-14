<template>  
    <div>
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <div class="buttons" v-if="!lock">
            <button @click="add_item" class="button is-small is-primary">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>
                <span>
                    Agregar {{section}}
                </span>
            </button>
        </div>
        <div v-for="(item, index) in evaluacion " :key="index">            
            <table class="table is-fullwidth is-bordered table-evaluation" v-if="item.section == section">
                <thead>
                    <tr class="tr_table">
                        <th>
                            {{section}}
                        </th>
                        <th v-for="(opt, i) in options" :key="i" v-html="opt.text">
                            <!-- {{opt.text}} -->
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="item.data.length == 0">
                        <td colspan="5" style="text-align:center;">Sin {{section}}</td>
                    </tr>
                    <tr v-for="(d,j) in item.data" :key="j">
                        <td :style="{ backgroundColor: d.color||'#ffffff'}">
                            {{d.name}}
                        </td>
                        <td v-for="(o2, k) in options" :key="k" @click="() => {if(lock) return;  d.color = o2.color; d.value = o2.value}">
                            <input type="radio"  :name="`q_${j}`" :disabled="lock" v-model="d.value" :value="o2.value" @click="() => {d.color = o2.color; d.value = o2.value}">                                   
                        </td>
                    </tr>
                </tbody> 
            </table>           
        </div>  
        <br>
        <div class="buttons">
            <a :disabled="prev == null" :href="prev" class="button  is-warning">Anterior</a>
            <button class="button is-success" @click="save">{{next.message}}</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ToastProgrammatic } from 'buefy';

export default {
    props: ['v_evaluacion', 'section', 'base_url', 'v_lock'],    
    methods: {                
        add_item()
        {
            this.$buefy.dialog.prompt({
                message: `¿Competencia ó Conocimiento que deseas agregar?`,
                inputAttrs: {
                    placeholder: 'Competencia o conocimiento',                    
                },
                trapFocus: true,
                onConfirm: (value) => {
                    let index = this.evaluacion.findIndex(f => f.section == this.section);
                    if(index != -1) {
                        this.evaluacion[index].data.push({name: value, value: 0});                
                    }
                }
            });
        },
        save() {
            this.isLoading = true;                        
            let is_complete = this.evaluacion.find(f => f.section == this.section).data.filter(f2 => f2.value == 0 ).length == 0                            
            axios
            .put(this.base_url, {evaluacion: this.evaluacion, next_section: this.next.section, is_complete})
            .then(({data}) => {
                console.log(data);                
                if(is_complete) {
                    let url = data.next||`${this.base_url}/edit?section=${this.next.section}`;
                    window.location.href = url;
                }
                else {
                    this.isLoading = false;
                    ToastProgrammatic.open({
                        message: 'Avance guardado, aún quedan preguntas sin responder', 
                        type: 'is-warning',
                        duration: 3000, 
                        position: 'is-bottom'
                    });
                }
            })
            .catch(() => {
                this.isLoading = false;
            })
        }
    },  
    mounted() {                
    },
    data() {
        let index = this.v_evaluacion.findIndex(f => f.section == this.section);
        let prev = index <= 0 ? null : `?section=${this.v_evaluacion[index-1].section}`;
        let next = index == this.v_evaluacion.length - 1 ? {message: 'Finalizar', section: null} : {message: 'Siguiente', section: this.v_evaluacion[index+1].section}
        console.log(this.v_evaluacion);

        return {                         
            prev, 
            next, 
            lock: !!this.v_lock,
            isLoading: false,
            evaluacion: this.v_evaluacion,
            options: [
                { color:'#a9d0be', text: 'Siempre se observa', value: 3, },
                { color:'#9bc3e6', text: 'Se observa poco', value: 2, },
                { color:'#f4b084', text: 'No se observa' , value: 1, },
                { color:'#d0cece', text: 'Esta competencia/conocimiento<br>no es necesaria', value: -1, },
            ],
        }
    }
}
</script>

<style scoped>
    .td-question{
        text-align:left !important;
    }
    .tr_table > th{ 
        vertical-align: middle;
    }
</style>