<template>
    <b-modal
        id="modal-inventory"
        ref="modal"
        :title="action === CREATE ? 'Create inventory' : 'Update inventory #'+inventory.id"
        @hidden="resetModal"
        @ok="handleOk"
    >
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input"
                invalid-feedback="Name is required"
                :state="nameState"
            >
                <b-form-input
                    id="name-input"
                    v-model="inventory.name"
                    :state="nameState"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label="Description"
                label-for="description-input"
                invalid-feedback="Description is required"
                :state="descriptionState"
            >
                <b-form-textarea
                    id="description-input"
                    v-model="inventory.description"
                    :state="descriptionState"
                    required
                ></b-form-textarea>
            </b-form-group>
            <b-form-group
                label="Branch"
                label-for="branch-input">
                <b-form-select v-model="inventory.branch" :options="branchOptions">
                    <template #first>
                        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                    </template>
                </b-form-select>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdateInventoryModal",
    props: ['action', 'inventory'],
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            nameState: null,
            descriptionState: null,
            branchOptions: []
        }
    },
    asyncComputed: {
        getBranches() {
            let self = this;
            return axios.get('/get-filter/branch')
                .then((response)=>{
                    self.branchOptions = response.data.data;
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
                axios.post(window.routes.inventory_store, this.inventory)
                    .then((response)=>{
                        self.$emit('updateInventory')
                    });
            } else if(this.action === this.UPDATE) {
                axios.patch('inventory/'+this.inventory.id, this.inventory)
                    .then((response)=>{
                        self.$emit('updateInventory')
                    })
            }
        },
        resetModal(){
            this.form = {
                name: null,
                description: null,
                branch: null
            }
            this.modal = {
                action: this.CREATE,
                title: 'Create new inventory',
                editItemId: null
            }
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
