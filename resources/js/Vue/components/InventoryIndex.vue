<template>
    <div>
<!--        <simple-table :inventories="inventories" :fields="fields"></simple-table>-->
            <b-row>
                <b-col cols="2">
                    <b-button variant="success" v-b-modal.modal-inventory>Add new inventory</b-button>
                </b-col>
                <b-col cols="10">
                    <b-pagination
                        align="right"
                        v-model="currentPage"
                        :total-rows="items.length"
                        :per-page="perPage"
                        aria-controls="my-table"
                    ></b-pagination>
                </b-col>
            </b-row>
        <div class="overflow-auto">
            <b-table striped hover
                     :busy="isBusy"
                     id="my-table"
                     :items="items"
                     :fields="fields"
                     :per-page="perPage"
                     :current-page="currentPage"
                     small>
                <template #table-busy>
                    <div class="text-center text-danger my-2">
                        <b-spinner class="align-middle"></b-spinner>
                        <strong>Loading...</strong>
                    </div>
                </template>
                <template #cell(actions)="row">
                    <b-button variant="warning" size="sm" @click="onEdit(row.item)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button variant="danger" size="sm" @click="onDelete(row.item)">
                        Delete
                    </b-button>
                </template>
            </b-table>
        </div>
        <b-modal
            id="modal-inventory"
            ref="modal"
            :title="modal.title"
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
                        v-model="form.name"
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
                        v-model="form.description"
                        :state="descriptionState"
                        required
                    ></b-form-textarea>
                </b-form-group>
            </form>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "InventoryIndex",
    data() {
        return {
            modal: {
                action: this.CREATE,
                title: 'Create inventory',
                editItemId: null
            },
            isBusy: false,
            currentPage: 1,
            nameState: null,
            descriptionState: null,
            perPage: 25,
            form: {
                name: null,
                description: null
            },
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            items: [],
            fields: [
                {key:'id'},
                {key:'name'},
                {key:'description'},
                {key:'user.name'},
                {key:'actions'},
            ]
        }
    },
    methods: {
        onEdit(item) {
            this.form.name = item.name;
            this.form.description = item.description;
            this.modal.action = this.UPDATE;
            this.modal.editItemId = item.id;
            this.modal.title = 'Update inventory #'+item.id;
            this.$bvModal.show('modal-inventory');

        },
        onDelete(item) {
            axios.delete('inventory/'+item.id)
                .then((response)=>{
                    this.getItems();
                })
        },
        resetModal(){
            this.form = {
                name: null,
                description: null
            }
            this.modal = {
                action: this.CREATE,
                title: 'Create new inventory',
                editItemId: null
            }
        },
        handleOk() {
            if(!this.validate()) {
                return false;
            }
            if(this.modal.action === this.CREATE) {
                axios.post(window.routes.inventory_store, this.form)
                    .then((response)=>{
                        this.users = response.data.users;
                        this.getItems();
                    });
            } else if(this.modal.action === this.UPDATE) {
                axios.patch('inventory/'+this.modal.editItemId, this.form)
                    .then((response)=>{
                        this.getItems();
                    })
            }
        },
        getItems() {
            this.isBusy = true;
            axios.get(window.routes.inventory_get_items)
                .then((response)=>{
                    this.items = response.data.inventories;
                    this.isBusy = false;
                })
        },
        validate() {
            let result = true;
            return result
        }
    },
    created() {
        this.getItems();
    }
}
</script>


