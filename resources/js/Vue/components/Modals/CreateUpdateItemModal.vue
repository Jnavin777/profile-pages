<template>
    <b-modal
        id="modal-item"
        ref="modal"
        :title="action === CREATE ? 'Create item' : 'Update item #'+item.id"
        @hidden="resetModal"
        @ok="handleOk"
    >
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input"
                invalid-feedback="Name is required"
                :state="nameState">
                <b-form-input
                    id="name-input"
                    v-model="item.name"
                    :state="nameState"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label="Condition"
                label-for="condition-input">
                <b-form-select v-model="item.condition" :options="conditionOptions">
                    <template #first>
                        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                    </template>
                </b-form-select>
            </b-form-group>
            <b-form-group
                label="Article"
                label-for="article-input"
                invalid-feedback="Article is required">
                <b-form-input
                    id="name-input"
                    v-model="item.article"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label="Category"
                label-for="category-input">
                <b-form-select v-model="item.categoryId" :options="categoryOptions">
                    <template #first>
                        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                    </template>
                </b-form-select>
            </b-form-group>
            <b-form-group
                label="Date of receiving"
                label-for="date-of-receiving-input">
                <b-form-input
                    id="date-of-receiving-input"
                    type="date"
                    v-model="item.dateOfReceiving"
                    required
                ></b-form-input>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdateItemModal",
    props: ['action', 'item', ''],
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            nameState: null,
            descriptionState: null,
            conditionOptions: [],
            categoryOptions: []
        }
    },
    asyncComputed: {
        getConditions() {
            let self = this;
            return axios.get('/get-filter/condition')
                .then((response)=>{
                    self.conditionOptions = response.data.data;
                })
        },
        getCategories() {
            let self = this;
            return axios.get('/get-filter/category')
                .then((response)=>{
                    self.categoryOptions = response.data.data;
                })
        }
    },
    methods: {
        handleOk() {
            let self = this;
            if(!this.validate()) {
                return false;
            }
            if(this.action === this.CREATE) {
                axios.post(window.routes.item_store, this.item)
                    .then((response)=>{
                        self.$emit('updateItem');
                    });
            } else if(this.action === this.UPDATE) {
                axios.patch('/item/'+this.item.id, this.item)
                    .then((response)=>{
                        self.$emit('updateItem')
                    })
            }
        },
        resetModal(){
            this.$emit('resetItemModal')
        },
        validate() {
            let result = true;
            return result
        }
    },
    created() {
        this.resetModal();
    }
}
</script>

<style scoped>

</style>
