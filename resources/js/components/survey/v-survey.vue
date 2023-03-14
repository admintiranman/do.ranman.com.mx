<template>  
   <div>
       <table class="table is-fullwidth is-bordered table-evaluation" v-for="summary in survey.summaries" :key="summary.id">
           <thead>
               <tr>
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
                    <td :id="'q_' + question.id" v-html="question.text" style="text-align:left !important;">                        
                    </td>
                    <td v-for="opt in summary.options" :key="opt.id">                        
                        <div class="control">
                            <label for="" class="radio">
                                <input @change="() => change(question.id, opt.color)" type="radio" :name="'q_' + question.id" />
                            </label>
                        </div>
                    </td>
                    <td>
                        <textarea class="textarea" v-if="response"></textarea>
                    </td>                                    
                </tr>
               </template>
           </tbody>
       </table>
   </div>       
</template>

<script>
export default {
    props: ['survey', 'response'],    
    methods: {        
        change(id, color) {
            let el = document.getElementById('q_' + id);
            el.style = `background-color:${color};`
        }
    },
    mounted() {
        console.log(this.survey);
    },
    data() {
        return {
            encuesta: this.survey            
        }
    }
}
</script>

<style>
    .td-question{
        text-align:left !important;
    }
</style>