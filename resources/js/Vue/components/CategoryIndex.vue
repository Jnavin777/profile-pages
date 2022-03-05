<template>
    <div>
<!--        <simple-table :inventories="items" :fields="fields"></simple-table>-->
            <b-row>
                <b-col cols="2">
                    <b-button variant="success" v-b-modal.modal-category>Add new category</b-button>
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
                    <b-button variant="info" size="sm" :href="'category/'+row.item.id" class="mr-1">
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
        <b-modal
            id="modal-category"
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
            </form>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "CategoryIndex",
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            modal: {
                action: null,
                title: null,
                editItemId: null
            },
            isBusy: false,
            currentPage: 1,
            nameState: null,
            perPage: 25,
            form: {
                name: null
            },
            items: [],
            fields: [
                {key:'id'},
                {key:'name'},
                {key:'user.name'},
                {key:'actions'},
            ]
        }
    },
    methods: {
        onEdit(item) {
            this.form.name = item.name;
            this.modal.action = this.UPDATE;
            this.modal.editItemId = item.id;
            this.modal.title = 'Update category #'+item.id;
            this.$bvModal.show('modal-category');

        },
        onDelete(item) {
            axios.delete('category/'+item.id)
                .then((response)=>{
                    this.getItems();
                })
        },
        resetModal(){
            this.form = {
                name: null
            }
            this.modal = {
                action: this.CREATE,
                title: 'Create new category',
                editItemId: null
            }
        },
        handleOk() {
            if(!this.validate()) {
                return false;
            }
            if(this.modal.action === this.CREATE) {
                axios.post(window.routes.category_store, this.form)
                    .then((response)=>{
                        this.getItems();
                    });
            } else if(this.modal.action === this.UPDATE) {
                axios.patch('category/'+this.modal.editItemId, this.form)
                    .then((response)=>{
                        this.getItems();
                    })
            }
        },
        getItems() {
            this.isBusy = true;
            axios.get(window.routes.category_get_items)
                .then((response)=>{
                    this.items = response.data.categories;
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


