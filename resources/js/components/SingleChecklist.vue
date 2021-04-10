<template>
    <div style="margin-bottom: 20px;" class="card">
        <div class="card-header single-list checklist-item">
            <span class="checklist-title">
                <h2>
                   {{ checklist.name }}
                </h2>
            </span>
            <div>
                <a
                    :href="['/show/checklist/' + checklist.id]"
                    type="button"
                    class="btn btn-success btn-sm"
                    ><i class="fa fa-eye"></i> Open</a
                >
                <a
                    href=""
                    type="button"
                    class="btn btn-primary btn-sm"
                    ><i class="fa fa-pencil-square-o"></i> Edit</a
                >
                <a
                    @click="deleteChecklist(checklist.id)"
                    type="button"
                    class="btn btn-danger btn-sm"
                    ><i class="fa fa-trash-o"></i> Delete</a
                >
            </div>
        </div>

        <div class="card-body">
            <div class="checklist-content">
                <div class="checklist-info">
                    <p>Description: {{ checklist.description }}</p>
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
                overallTasks: 0
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
        }
    }
</script>