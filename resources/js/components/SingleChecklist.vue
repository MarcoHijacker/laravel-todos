<template>
    <div style="margin-bottom: 20px;" class="card">
        <div class="card-header single-list checklist-item">
            <div class="checklist-title">
                <input :class="[isIconActive ? '' : 'hidden-input']" type="text" v-model="checklist.name" :disabled="isDisabled">
            </div>
            <div>
                <a
                    @click="deleteChecklist(checklist.id)"
                    type="button"
                    class="action-crud"
                    ><i class="fa fa-trash"></i></a
                >
                <a
                    @click="unlockEditActions"
                    type="button"
                    class="action-crud"
                    ><i class="fa fa-pencil"></i></a
                >
                <a 
                    @click="editChecklist(isIconActive, checklist.id)"
                    aria-hidden="true"
                ><i :class="['fa fa-check', isIconActive ? '' : 'deniedAct']"></i></a>
                <a
                    :href="['/show/checklist/' + checklist.id]"
                    type="button"
                    class="action-crud"
                    ><i class="fa fa-eye"></i></a
                >
            </div>
        </div>

        <div class="card-body">
            <div class="checklist-content">
                <div class="checklist-info">
                    <p><input :class="[isIconActive ? '' : 'hidden-input']" type="text" v-model="checklist.description" :disabled="isDisabled"></p>
                    <p>
                        Completed Tasks:
                        <span class="checklist-field">
                            {{ completedTasks }}
                        </span>
                    </p>
                    <p>
                        Overall Tasks:
                        <span class="checklist-field">
                            {{ overallTasks }}
                        </span>
                    </p>
                </div>
                <div class="checklist-bar">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                trash: {},
                relatedTasks: {},
                completedTasks: 0,
                overallTasks: 0,
                isDisabled: true,
                isIconActive: false,
                newMove: '',
            };
        },
        mounted() {
            this.getRelatedTasks();
        },
        props: {
            checklist: Object,
        },
        methods: {
            deleteChecklist(id) {
                if(confirm('This will perform permanent deletion. Are you sure?')) {
                    axios
                        .delete("http://127.0.0.1:8000/api/checklists/" + id)
                        .then(response => {
                            this.trash = response.data;
                        })
                        .finally(() => {
                            this.$emit("upd-checklists");
                            this.getRelatedTasks();
                            console.log('Checklist deleted from DB!');
                        });
                }
            },
            getRelatedTasks() {
                axios
                    .get("http://127.0.0.1:8000/api/tasks/balance/" + this.checklist.id)
                    .then(response => {
                        this.completedTasks = response.data['completed'];
                        this.overallTasks = response.data['overall'];
                    })
                    .finally(() => {
                        // Nothing to say here...
                    });
            },
            editChecklist(isIconActive, id) {
            if (isIconActive) {
                axios
                    .post("http://127.0.0.1:8000/api/checklists/" + id, this.checklist)
                    .then(({ data }) => console.log(data))
                    .finally(() => {
                        this.newMove = 'Edited Checklist ID ' + id;
                        this.$emit("upd-checklists");
                        this.$emit("new-move", this.newMove);
                        this.unlockEditActions();
                    });
            }
            },
            unlockEditActions() {
                this.isDisabled = !this.isDisabled;
                this.isIconActive = !this.isIconActive;
            },
        }
    }
</script>