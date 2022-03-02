<template>
    <div class="overflow-auto">
        <b-pagination
            align="right"
            v-model="currentPage"
            :total-rows="inventories.length"
            :per-page="perPage"
            aria-controls="my-table"
        ></b-pagination>
        <b-table striped hover
            id="my-table"
            :items="inventories"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            small
        ></b-table>
    </div>
</template>

<script>
export default {
    name: "SimpleTable",
    props: ['inventories', 'fields'],
    data() {
        return {
            currentPage: 1,
            perPage: 25,
            fields: [
                {key:'id'},
                {key:'title'},
                {key:'description'},
                {key:'user_id'},
            ]
        }
    }
}
</script>

<style scoped>

</style>
