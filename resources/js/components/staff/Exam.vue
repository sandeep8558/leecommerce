<template>
    <div class="container-fluid p-0">

        <div class="container-fluid mb-5">
            <button @click="addNew=!addNew" class="btn" :class="[(addNew ? 'btn-danger' : 'btn-primary')]">{{addNew ? 'Close Form' : 'Add New Exam'}}</button>
        </div>

        <div v-if="addNew">

            <div v-if="step.active==0" class="row m-0">
                <div class="col-12 mb-3">
                    <h4><u>Exam Name & Description</u></h4>
                </div>
                <div class="col-12 mb-3">
                    <label for="exam_name" class="form-label">Exam Name</label>
                    <input type="text" class="form-control" id="exam_name" name="exam_name" v-model="req.exam_name" @input="validate()">
                </div>
            </div>

            <div v-if="step.active==1" class="row m-0">
                <div class="col-12 mb-3">
                    <h4><u>Exam Batches</u></h4>
                </div>
                <div class="col-12 mb-3">
                    <div v-for="batch in batches" :key="batch.open_batch.id" class="form-check">
                        <input @change="setStudents()" class="form-check-input" type="checkbox" :id="'batch'+batch.open_batch.id" v-model="req.batches" :value="batch.open_batch.id">
                        <label class="form-check-label" :for="'batch'+batch.open_batch.id" name="batches">{{batch.open_batch.batch_name}}</label>
                    </div>
                </div>
            </div>

            <div v-if="step.active==2" class="row m-0">
                <div class="col-12 mb-3">
                    <h4><u>Exam Students</u></h4>
                </div>
                <div class="col-12 mb-3">
                    <div v-for="bat in selectedBatches" :key="bat.open_batch.id">
                        <div v-for="b in bat.open_batch.batch_students" :key="b.student_course_id" class="form-check">
                            <input @change="validate()" class="form-check-input" type="checkbox" :value="b.student_course.id" :id="'student'+b.student_course.id" v-model="req.students">
                            <label class="form-check-label" :for="'student'+b.student_course.id" name="students">{{b.student_course.student.fname}} {{b.student_course.student.mname}} {{b.student_course.student.lname}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div v-for="(sub, index) in examSubjects" :key="sub.id">
                <div v-if="step.active==( step.last - req.subjects.length + index + 1 )" class="row m-0">
                    <div class="col-12 mb-3">
                        <h4><u>Exam Subjects and Invigilator</u></h4>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <b>{{ sub.course }} - {{ sub.subject }}</b>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="dt" class="form-label">{{ sub.subject }} Exam Date</label>
                                <input type="date" class="form-control" id="dt" name="dt" v-model="req.subjects[index].dt">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="total_marks" class="form-label">{{ sub.subject }} Total Marks</label>
                                <input type="text" class="form-control" id="total_marks" name="total_marks" v-model="req.subjects[index].total_marks">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Select invigilator for {{ sub.subject }}</label>
                                <div class="form-check" v-for="(staff, i) in staffs" :key="staff.id">
                                    <input class="form-check-input" type="checkbox" :id="'invigilator'+staff.id+i" v-model="req.subjects[index].invigilator" :value="staff.id">
                                    <label class="form-check-label" :for="'invigilator'+staff.id+i">{{ staff.employee_name }}</label>
                                </div>
                            </div>

                            <!-- <div class="col-12 mb-3">
                                <label class="form-label">Please select Classrooms</label>
                                <div v-for="(classroom, ii) in classrooms" :key="classroom.id">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="'classroom'+classroom.id" v-model="req.subjects[index].classrooms" :value="classroom.id" @change="makeSlots()">
                                        <label class="form-check-label" :for="'classroom'+classroom.id">{{ classroom.classroom_name }}</label>
                                    </div>

                                    <div class="form-check" v-for="(slot, iii) in classroom.slts" :key="slot.id">
                                        <input class="form-check-input" type="checkbox" :name="'slot'+slot.id+'-'+ii" :id="'slot'+slot.id+'-'+ii" :value="slot.id">
                                        <label class="form-check-label" :for="'slot'+slot.id+'-'+ii">{{ slot.name }} {{ 'slot'+slot.id+'-'+ii }}</label>
                                    </div>

                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid mb-3">
                <button v-if="step.active != step.first" @click="navigateForm('prev')" :class="[(step.active==step.first ? 'disabled' : '')]" class="btn btn-outline-primary">Previous</button>
                <button v-if="step.active != step.last" @click="navigateForm('next')" :class="[(validation ? '' : 'disabled')]" class="btn btn-outline-primary">Next</button>
                <button v-if="step.active == step.last" @click="save()" class="btn btn-primary">Save Exam</button>
            </div>

        </div>

        <div class="container-fluid mb-5">            
            <div class="row mb-4" v-for="exam in exams.data" :key="exam.id">
                <div class="col-12"><h4>{{ exam.exam_name }}</h4></div>
                <div class="col-12" v-for="batch in exam.exam_batches" :key="batch.id">{{ batch.batch.batch_name }}</div>
                <div class="col-12">
                    <div class="row" v-for="sub in exam.exam_subjects" :key="sub.id">
                        <div class="col">{{ sub.subject.subject }}</div>
                        <div class="col-auto" v-for="invigilator in sub.exam_subject_invigilators" :key="invigilator.id">{{ invigilator.staff.employee_name }}</div>
                        <div class="col-auto">{{ sub.dt }}</div>
                        <div class="col-auto">{{ sub.total_marks }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-warning btn-sm">Edit</button>
                    <button @click="deleteExam(exam.id)" class="btn btn-outline-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>

        <div class="container-fluid mb-5">
            <button :class="[(exams.prev_page_url==null ? 'disabled' : '')]" @click="getExams(exams.current_page - 1)" class="btn btn-outline-primary">Previous</button>
            <button :class="[(exams.next_page_url==null ? 'disabled' : '')]" @click="getExams(exams.current_page + 1)" class="btn btn-outline-primary">Next</button>
        </div>

    </div>
</template>

<script>

import { debounce } from 'vue-debounce';

/* interface Classroom {
    rooms: [],
    slots: [],
} */

export default {

    props: ['batches', 'staffs', 'classrooms'],

    components: {
    },

    data: function (){
        return {
            addNew: false,
            validation: false,
            selectedBatches: [],
            examSubjects: [],
            req : {
                id: null,
                exam_name: null,
                batches: [],
                students: [],
                subjects: [],
            },
            step : {
                active: 0,
                first: 0,
                last: 2,
            },
            exams : {
                current_page : null,
                data: [],
                first_page_url: null,
                from: null,
                next_page_url: null,
                path: null,
                per_page: null,
                prev_page_url: null,
                to: null,
            },
        }
    },

    methods : {

        save(){
            let url = "/mystaff/exam/save";
            window.axios.post(url, {data: this.req}).then(res => {
                console.log(res);
                this.clearForm();
                this.getExams();
            });
        },

        deleteExam(exam_id){
            let c = confirm("Are you sure to delete this exam?" + exam_id);
            if(c){
                let url = "/mystaff/exam/delete";
                window.axios.post(url, {exam_id: exam_id}).then(res => {
                    console.log(res);
                    this.getExams();
                });
            }
        },

        clearForm(){
            this.req.id = null;
            this.req.exam_name = null;
            this.req.batches = [];
            this.req.students = [];
            this.req.subjects = [];
            this.step.active = 0;
            this.step.last = 2;
            this.addNew = false;
        },

        setStudents(){
            this.validate();
            let b = [];
            let s = [];
            if(this.req.batches.length > 0){
                this.req.batches.forEach((batch_id, i) => {
                    this.batches.forEach(batch => {
                        if(batch_id == batch.batch_id){
                            b.push(batch);
                            batch.open_batch.batch_courses.forEach(bc => {
                                bc.course.subjects.forEach(sub => {
                                    if(sub.status == "Active"){
                                        sub.course = bc.course.course;
                                        s.push(sub);
                                    }
                                });
                            });
                        }
                    });
                });
            }
            this.selectedBatches = b;
            this.examSubjects = s;
            this.setSubjects();
        },

        makeSlots(){
            console.log(this.req);
        },

        setSubjects(){
            let subs = [];
            this.examSubjects.forEach(sub => {
                let s = {
                    subject_id: sub.id,
                    dt: null,
                    total_marks: 100,
                    invigilator: [],
                    /* classrooms: [],
                    slots: [], */
                };
                subs.push(s);
            });
            this.req.subjects = subs;
            this.step.last += this.req.subjects.length;
        },

        validate: debounce(function(){
            this.validation = false;
            switch(this.step.active){
                case 0:
                this.validation = this.req.exam_name != null && this.req.exam_name != "" ? true : false;
                break;

                case 1:
                this.validation = this.req.batches.length > 0 ? true : false;
                break;

                case 2:
                this.validation = this.req.students.length > 0 ? true : false;
                break;

                case 3:
                this.validation = true;
                break;

                case 4:
                this.validation = true;
                break;
            }
        }, 100),


        navigateForm(what){
            this.validate();
            if(what=='prev'){
                if(this.step.active > this.step.first){
                    this.step.active -= 1;
                }
            } 
            if(what=='next'){
                if(this.step.active < this.step.last){
                    this.step.active += 1;
                }
            }
        },

        getExams(current_page = 1){
            window.axios.get('/mystaff/exam/all?page=' + current_page).then(res => {
                this.exams = res.data;
            });
        },

        /* getBusinessPlan(){
            window.axios.get('/auth/crud/showall?model=BusinessPlan&key=plan_name&val=id').then(res => {
                this.formData.elements[1].options = res.data;
            });
        } */

    },

    created(){

        this.validate();

        
        
    },

    mounted() {
        this.getExams();
    },

}
</script>
