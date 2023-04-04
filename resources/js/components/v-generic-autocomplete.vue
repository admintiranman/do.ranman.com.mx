<template>
    <b-autocomplete
        v-model="search"
        field="name"
        :clear-on-select="clearInput"
        :data="filter" 
        @select="(option) => {$emit('select', option)}"        
        :placeholder="placeholder"    
        :name="name"

    >
    </b-autocomplete>
</template>

<script>
    export default {
        props: ['options', 'placeholder', 'clear', "inputname", "value"],
        computed: {
            filter() {
                let txt = this.search.toLowerCase();            
                txt = txt.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(" ", ".*");
                const finder = new RegExp(`.*${txt}.*`);
                return this.options.filter(
                (f) => f.name.toLowerCase()
                        .normalize("NFD")
                        .replace(/[\u0300-\u036f]/g, "")
                        .match(finder)
                );
            }
        },  
        mounted() {
            console.debug("Monted clear" ,  this.clear);

        },
        data() {


            return  {
                search: this.value || "",
                name: this.inputname||"username",
                clearInput: this.clear != undefined ? this.clear : true,
            }
        }

        
    }
</script>

<style lang="scss" scoped>

</style>