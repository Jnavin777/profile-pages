<template>
    <b-modal
        id="modal-branch"
        ref="modal"
        :title="action === CREATE ? 'Create branch' : 'Update branch #'+branch.id"
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
                    v-model="branch.name"
                    :state="nameState"
                    required
                ></b-form-input>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdateBranchModal",
    props: ['action', 'branch'],
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            modal: {
                action: null,
                title: null,
                editItemId: null
            },
            nameState: null
        }
    },
    methods: {
        handleOk() {
            let self = this;
            if(!this.validate()) {
                return false;
            }
            if(this.action === this.CREATE) {
                axios.post(window.routes.branch_store, this.branch)
                    .then((response)=>{
                        self.$emit('updateBranch')
                    });
            } else if(this.action === this.UPDATE) {
                axios.patch('/branch/'+this.branch.id, this.branch)
                    .then((response)=>{
                        self.$emit('updateBranch')
                    })
            }
        },
        resetModal(){
            this.$emit('resetBranchModal')
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
