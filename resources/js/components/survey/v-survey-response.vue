<template>  
    <div>
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <div v-for="summary in encuesta" :key="summary.id">
            <table class="table is-fullwidth is-bordered table-evaluation" v-if="summary.text == section">
                <thead>
                    <tr class="tr_table">
                        <th width="400" colspan="2">
                            {{summary.text}}
                        </th>
                        <th width="450">
                            Pregunta
                        </th>
                        <th v-for="option in summary.options" :key="option.id">
                            {{option.text}}
                        </th>
                        <th width="300"> 
                            Comentarios
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(subsummary, index) in summary.subsummaries">
                    <tr  :key="subsummary.text">
                        <td :rowspan="subsummary.questions.length +1">
                            {{index+1}}
                        </td>
                        <td  :rowspan="subsummary.questions.length + 1" v-html="subsummary.text">
                        </td>                   
                    </tr>
                    <tr v-for="question in subsummary.questions" :key="question.id">
                            <td :id="'q_' + question.id" v-html="question.text" style="text-align:left !important;" :style="{backgroundColor: question.color||'#ffffff'}">
                            </td>
                            <td v-for="(opt) in summary.options" :key="opt.id" @click="() => {if(lock)return; question.value = opt.value; question.color = opt.color; }">
                                <input :disabled="lock" type="radio" v-model="question.value" :value="opt.value"  :name="`q_${question.id}`" :id="`q_${question.id}_o_${opt.value}`" @click="() => {question.value = opt.value; question.color = opt.color}"/>
                            </td>
                            <td>
                                <textarea :readonly="lock" rows="2" class="textarea" v-model="question.comments"></textarea>
                            </td>                                    
                        </tr>
                    </template>
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
    props: ['survey', 'section', 'base_url', 'v_lock'],    
    computed: {
        next_message: function () {
            let a = this.encuesta.fin(f => f.text == this.section)
        }
    },
    methods: {                
        save() {
            this.isLoading = true;
            let is_complete = this.survey.find(f => f.text == this.section).subsummaries.filter(f =>  f.questions.find(q => q.value == 0)).length == 0;        
            axios
            .put(this.base_url, {survey: this.encuesta, next_section: this.next.section, is_complete})
            .then(({data}) => {
                console.log(data);
                
                if(is_complete) {
                    let url = data.next||this.next.url
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
        console.log(this.section);        
    },
    data() {
        let index = this.survey.findIndex(f => f.text == this.section);
        let next = index + 1 == this.survey.length ? {url:`${this.base_url}?section=finalizar_evaluacion`, message: 'Finalizar'} 
            : {message: 'Siguiente', url: `${this.base_url}?section=${this.survey[index+1].text}`, section: this.survey[index+1].text }
        let prev = index <= 0 ? null : `${this.base_url}?section=${this.survey[index-1].text}`;
        let encuesta = this.survey;
        encuesta.map(s => s.subsummaries.map(s2 => s2.questions.map(q => {q.color = q.color||'#ffffff'; q.value = q.value||0})));
        console.log(encuesta)
        return {      
            lock: !!this.v_lock,
            encuesta, 
            prev, 
            next, 
            isLoading: false            
        }
    }
}
</script>

<style>
    .td-question{
        text-align:left !important;
    }
    .tr_table > th{ 
        vertical-align: middle;
    }
</style>