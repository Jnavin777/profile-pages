<template>
    <div>
        <b-row>
            <b-col cols="2">
                <b-button variant="warning" @click="editBranch">Edit branch</b-button>
                <b-button variant="success" v-b-modal.modal-item>Add new inventory</b-button>
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
                    <b-button variant="info" size="sm" :href="'/inventory/'+row.item.id" class="mr-1">
                        <b-icon icon="eye"></b-icon>
                    </b-button>
                    <b-button variant="warning" size="sm" @click="onEdit(row.item)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button variant="danger" size="sm" @click="onDelete(row.item)">
                        Delete
                    </b-button>
                </template>
            </b-table>
        </div>
        <create-update-branch-modal
            :action="actionModal"
            :branch="branch"
            @updateBranch="updatedBranch">
        </create-update-branch-modal>

        <b-modal
            id="modal-item"
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
            >
                <b-form-textarea
                    id="description-input"
                    v-model="form.description"
                    required
                ></b-form-textarea>
            </b-form-group>
        </form>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "BranchShow",
    props: ['branch'],
    data() {
        return {
            actionModal: 'UPDATE',
            conditionOptions: [],
            categoryOptions: [],
            branchOptions: [],
            modal: {
                action: this.CREATE,
                title: 'Add new inventory',
                editItemId: null
            },
            isBusy: false,
            currentPage: 1,
            nameState: null,
            articleState: null,
            perPage: 25,
            form: {
                name: null,
                description: null,
            },
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            items: [],
            fields: [
                {key:'id', label:'ID'},
                {key:'name', label:'Name'},
                {key:'totalItems', label:'Items'},
                {key:'description', label:'Description'},
                {key:'actions', label:'Actions'},
            ]
        }
    },
    methods: {
        updatedBranch() {
            window.location.reload()
        },
        editBranch() {
            this.$bvModal.show('modal-branch');
        },
        onEdit(item) {
            this.form.name = item.name;
            this.form.description = item.description;

            this.modal.action = this.UPDATE;
            this.modal.editItemId = item.id;
            this.modal.title = 'Update inventory #'+item.id;
            this.$bvModal.show('modal-item');
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
                title: 'Add new inventory',
                editItemId: null
            }
        },
        handleOk() {
            if(!this.validate()) {
                return false;
            }
            this.form.branch = this.branch.id;
            this.form.inventoryId = this.inventoryId;
            if(this.modal.action === this.CREATE) {
                axios.post(window.routes.inventory_store, this.form)
                    .then((response)=>{
                        this.getItems();
                    });
            } else if(this.modal.action === this.UPDATE) {
                axios.patch('/inventory/'+this.modal.editItemId, this.form)
                    .then((response)=>{
                        this.getItems();
                    })
            }
        },
        getItems() {
            this.isBusy = true;
            axios.get('/branch/'+ this.branch.id + '/inventories')
                .then(({data:response})=>{
                    this.items = response.map(item => {
                        item.inventory.totalItems = item.totalItems
                        return item.inventory
                    });
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
        this.resetModal();
    }
}
</script>


