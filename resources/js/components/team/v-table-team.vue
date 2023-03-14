<template>
    <section>
          <b-table
            :data="data"
            default-sort="name"
            bordered
            default-sort-direction="asc"
            ref="table"
            paginated
            per-page="10"
            :opened-detailed="defaultOpenedDetails"
            detailed
            detail-key="id"
            :detail-transition="transitionName"            
            :show-detail-icon="showDetailIcon"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
            
            @details-open="detail_open"
            @details-close="detail_close"
            
            >

            <b-table-column v-slot="props" centered label="Nombre" sortable field="name">
                <a :href="`/user/${props.row.id}`">
                    {{ props.row.name }}
                </a>    
            </b-table-column>
            <b-table-column v-slot="props" centered label="Puesto" sortable field="job">
                {{ props.row.job.name }}
            </b-table-column>

            <template #detail="props">                
                <b-table                    
                    bordered                                                            
                    :data="props.row.objetivos"                                        
                >
                    <b-table-column v-slot="props" label="Objetivos">
                        {{props.row.year}}
                    </b-table-column>
                    <b-table-column v-slot="props" label="Inicial">
                        <a v-if="!!props.row.start_filename" target="_blank" :href="`/objetivo/${props.row.id}/inicio`">
                            {{props.row.start_filename}}
                            <b-icon v-if="props.row.start_lock" icon="lock" size="is-small"></b-icon>    
                        </a>
                        <a v-if="props.row.start_lock == 0" :href="`/objetivo/${props.row.id}/edit/inicio`">
                            <span class="icon">
                                <i class="fas fa-edit"></i>
                            </span>                                                    
                        </a>
                        
                    </b-table-column>
                    <b-table-column v-slot="props" label="Final">
                        <a v-if="!!props.row.end_filename" target="_blank" :href="`/objetivo/${props.row.id}/final`">
                            {{props.row.end_filename}}
                            <b-icon v-if="props.row.end_lock" icon="lock" size="is-small"></b-icon>    
                        </a>
                        <a v-if="props.row.end_lock == 0" :href="`/objetivo/${props.row.id}/edit/final`">
                            <span class="icon">
                                <i class="fas fa-edit"></i>
                            </span>                                                    
                        </a>
                        
                    </b-table-column>
                </b-table>

                <b-table :data="props.row.evaluaciones" bordered >
                    <b-table-column v-slot="props" label="Evaluaciones de desempeño y potencial">
                        <a :href="`/evaluacion/${props.row.uuid}`">                                    
                            {{props.row.control.name}}
                            <b-icon v-if="props.row.lock" icon="lock" size="is-small"></b-icon>                        
                        </a>
                    </b-table-column>                    
                </b-table>

                <b-table :data="props.row.retro" bordered >
                    <b-table-column v-slot="props" label="Retroalimentaciones">
                        <a :href="`/retroalimentacion/${props.row.id}/edit`">                                    
                            {{props.row.control.name}}
                            <b-icon v-if="props.row.lock" icon="lock" size="is-small"></b-icon>                        
                        </a>
                    </b-table-column>                    
                </b-table>

                <b-table :data="props.row.planes" bordered >
                    <b-table-column v-slot="props" label="Plan de desarrollo individual">
                        <a :href="`/pdi/${props.row.id}/edit`">     
                                                           
                            {{props.row.control.name}}
                            <b-icon v-if="props.row.lock" icon="lock" size="is-small"></b-icon>                        
                        </a>
                    </b-table-column>                    
                </b-table>

            </template>

        </b-table>
    </section>
</template>
<script>
export default {
    props: ['vdata'],    
    methods: {
        detail_open(row) {            
            this.defaultOpenedDetails.push(row.id);
            localStorage.setItem('v_table_team_ids', JSON.stringify(this.defaultOpenedDetails));
        },
        detail_close(row) { 
            this.defaultOpenedDetails = this.defaultOpenedDetails.filter(f => f != row.id);
            localStorage.setItem('v_table_team_ids', JSON.stringify(this.defaultOpenedDetails));
        }
    },
    data() {
        let defaultOpenedDetails = JSON.parse(localStorage.getItem('v_table_team_ids')||"[]");

        return {
            transitionName: "fade", 
            data: this.vdata || [],
            showDetailIcon: true, 
            defaultOpenedDetails
        }
    }
}
</script>
<style>
</style>