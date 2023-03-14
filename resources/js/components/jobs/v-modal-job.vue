  <template>
    <div>
        <p class="title is-4 is-spaced">
            {{name}} <span class="has-text-link is-clickable" @click="openModal">({{job}})</span>
        </p>
        <hr/>

        <div class="modal" :class="isActive ? 'is-active' : ''">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        {{job}}
                        <span v-if="is_admin">
                            &nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" :href="`/admin/jobs/${job_id}/edit`">Editar</a>
                        </span>                        
                    </p>                    
                    <button class="delete" aria-label="close" @click="() => this.isActive = false"></button>
                </header>
                <section class="modal-card-body">
                    <b-table :data="data" :loading="isLoading" bordered >
                        <b-table-column v-slot="props" label="Competencias culturales">
                            <b-tooltip multilined square type="is-dark" :label="props.row.core.notas" v-if="props.row.core.notas">
                                {{props.row.core.name}}
                            </b-tooltip>
                            <span v-else>
                                {{props.row.core.name}}
                            </span>
                        </b-table-column>                                            
                        <b-table-column v-slot="props" label="Competencias del puesto">
                            <b-tooltip multilined square type="is-dark" :label="props.row.job.notas" v-if="props.row.job.notas">
                                {{props.row.job.name}}
                            </b-tooltip>
                            <span v-else>
                                {{props.row.job.name}}
                            </span>
                        </b-table-column>                                            
                        <b-table-column v-slot="props" label="Conocimientos">
                            <b-tooltip multilined square type="is-dark" :label="props.row.knowledge.notas" v-if="props.row.knowledge.notas">
                                {{props.row.knowledge.name}}                                
                            </b-tooltip>
                            <span v-else>
                                {{props.row.knowledge.name}}
                            </span>
                        </b-table-column>                                            
                        <b-table-column v-slot="props" label="Experiencia">
                            <b-tooltip multilined square type="is-dark" :label="props.row.experience.notas" v-if="props.row.experience.notas">
                                {{props.row.experience.name}}
                            </b-tooltip>
                            <span v-else>
                                {{props.row.experience.name}}
                            </span>
                        </b-table-column>                                            
                    </b-table>                                        
                </section>                                                                    
            </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['name', 'job', 'job_id', 'is_admin'], 
    methods: {
        closeModal() {
            this.isActive = false;
        },
        openModal() {
            this.data = [];
            this.isLoading = true
            this.isActive = true;
            axios.get(`/admin/job/competences/${this.job_id}`)
            .then(({data}) => {                
                this.data = data.data;
                console.log(data.data);
                this.isLoading = false;
            })
        }
    },
    data() {
        return {
            isActive: false,            
            data: [], 
            isLoading: false            
        }
    }
}
</script>

