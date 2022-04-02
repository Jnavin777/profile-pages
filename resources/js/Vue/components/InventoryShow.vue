<template>
    <div>
<!--        <simple-table :inventories="inventories" :fields="fields"></simple-table>-->
            <b-row>
                <b-col cols="2">
                    <b-button variant="warning" @click="editInventory">Edit inventory</b-button>
                    <b-button variant="success" v-b-modal.modal-item>Add new item</b-button>
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
<!--                    <b-button variant="info" size="sm" :href="'inventory/'+row.item.id" class="mr-1">-->
<!--                        <b-icon icon="eye"></b-icon>-->
<!--                    </b-button>-->
                    <b-button variant="warning" size="sm" @click="onEdit(row.item)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button variant="danger" size="sm" @click="onDelete(row.item)">
                        Delete
                    </b-button>
                </template>
            </b-table>
        </div>
        <create-update-inventory-modal
            :action="actionModal"
            :inventory="inventory"
            @updateInventory="getItems"></create-update-inventory-modal>
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
                    :state="nameState">
                    <b-form-input
                        id="name-input"
                        v-model="form.name"
                        :state="nameState"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Condition"
                    label-for="condition-input">
                    <b-form-select v-model="form.condition" :options="conditionOptions">
                        <template #first>
                            <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group
                    label="Article"
                    label-for="article-input"
                    invalid-feedback="Article is required"
                    :state="articleState">
                    <b-form-input
                        id="name-input"
                        v-model="form.article"
                        :state="articleState"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Category"
                    label-for="category-input">
                    <b-form-select v-model="form.categoryId" :options="categoryOptions">
                        <template #first>
                            <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                        </template>
                    </b-form-select>
                </b-form-group>
<!--                <b-form-group-->
<!--                    label="Branch"-->
<!--                    label-for="branch-input">-->
<!--                    <b-form-select v-model="form.branchId" :options="branchOptions">-->
<!--                        <template #first>-->
<!--                            <b-form-select-option :value="null" disabled>&#45;&#45; Please select an option &#45;&#45;</b-form-select-option>-->
<!--                        </template>-->
<!--                    </b-form-select>-->
<!--                </b-form-group>-->
                <b-form-group
                    label="Date of receiving"
                    label-for="date-of-receiving-input">
                    <b-form-input
                        id="date-of-receiving-input"
                        type="date"
                        v-model="form.dateOfReceiving"
                        required
                    ></b-form-input>
                </b-form-group>
            </form>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "InventoryShow",
    props: ['inventory','conditions','categories'],
    data() {
        return {
            actionModal: 'UPDATE',
            conditionOptions: [],
            categoryOptions: [],
            modal: {
                action: this.CREATE,
                title: 'Add new item',
                editItemId: null
            },
            isBusy: false,
            currentPage: 1,
            nameState: null,
            articleState: null,
            perPage: 25,
            form: {
                name: null,
                condition: null,
                article: null,
                categoryId: null,
                // branchId: null,
                dateOfReceiving: null,
            },
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            items: [],
            fields: [
                {key:'id', label:'ID'},
                {key:'name', label:'Name'},
                {key:'condition', label:'Condition'},
                {key:'article', label:'Article'},
                {key:'category.name', label:'Category'},
                {key:'date_of_receiving', label:'Date of receiving'},
                {key:'actions', label:'Actions'},
            ]
        }
    },
    methods: {
        updatedInventory() {
            window.location.reload()
        },
        editInventory() {
            this.$bvModal.show('modal-inventory');
        },
        onEdit(item) {
            this.form.name = item.name;
            this.form.condition = item.condition;
            this.form.article = item.article;
            this.form.categoryId = item.category_id;
            // this.form.branchId = item.branch_id;
            this.form.dateOfReceiving = item.dateOfReceiving;

            this.modal.action = this.UPDATE;
            this.modal.editItemId = item.id;
            this.modal.title = 'Update item #'+item.id;
            this.$bvModal.show('modal-item');

        },
        onDelete(item) {
            axios.delete('item/'+item.id)
                .then((response)=>{
                    this.getItems();
                })
        },
        resetModal(){
            this.form = {
                name: null,
                condition: null,
                article: null,
                categoryId: null,
                dateOfReceiving: null,
            }
            this.modal = {
                action: this.CREATE,
                title: 'Add new item',
                editItemId: null
            }
        },
        handleOk() {
            if(!this.validate()) {
                return false;
            }
            this.form.inventoryId = this.inventoryId;
            if(this.modal.action === this.CREATE) {
                axios.post(window.routes.item_store, this.form)
                    .then((response)=>{
                        this.getItems();
                    });
            } else if(this.modal.action === this.UPDATE) {
                axios.patch('/item/'+this.modal.editItemId, this.form)
                    .then((response)=>{
                        this.getItems();
                    })
            }
        },
        getItems() {
            this.isBusy = true;
            axios.get('/inventory/'+ this.inventoryId +'/get_item')
                .then((response)=>{
                    this.items = response.data.items;
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
        this.conditionOptions = Object.values(this.conditions).map( item => {
            return {
                value: item,
                text: item
            }
        })
        this.categoryOptions = this.categories.map( item => {
            return {
                value: item.id,
                text: item.name
            }
        })
    }
}
</script>


