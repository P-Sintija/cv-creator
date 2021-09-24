<template>
  <form class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
    <div>
      <h3 class="text-3xl text-gray-700">Izglītība</h3>
      <div class="flex flex-col gap-4"
        v-for="(education, index) in educations" :key="index">
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Iestāde</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="education.institution"
            value="education.institution"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Virziens</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="education.faculty"
            value="education.faculty"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Izglītības līmenis</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="education.level"
            value="education.level"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Statuss</label>
          <select class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            v-model="education.statuss">
            <option disabled value="">Izvēlaties vienu</option>
            <option>mācības pabeigtas</option>
            <option>pārtrauktas</option>
            <option>mācos</option>
          </select>
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Laika posms</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
          type="text" v-model="education.time" value="education.level" />
        </div>
        <div>
          <font-awesome-icon class="h-9 text-yellow-500" style="width: 40px !important;"
            :icon="saveIcon" 
            @click="editData(education)" 
            v-show="index == educations.length - 1"
          />
          <font-awesome-icon class="h-9 text-green-400" style="width: 40px !important;"
            :icon="addIcon"
            @click="addEducation(index)"
            v-show="index == educations.length - 1"
          />
          <font-awesome-icon class="h-9 text-red-400" style="width: 28px !important;"
            :icon="removeIcon"
            @click="removeEducation(index)"
            v-show="index || (!index && educations.length > 1)"
          />
        </div>
      </div>
    </div>
    <div v-if="errors.length" class="flex flex-col rounded p-8 shadow-md border-red-100 bg-red-50 text-red-800">
      <p>
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </p>
    </div>
  </form>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusSquare } from "@fortawesome/free-solid-svg-icons";
import { faSave } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";

export default {
  props: ["userEducation", "userBasicData"],
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      educations: [],
      removeIcon: faTrash,
      saveIcon: faSave,
      addIcon: faPlusSquare,
      errors: [],
    };
  },
  beforeMount() {
    this.setEducationValues();
  },
  methods: {
    setEducationValues() {
      for (let i = 0; i < this.userEducation.length; i++) {
        this.educations.push({
          educationId: this.userEducation[i].id,
          userId: this.userBasicData.user_Id,
          institution: this.userEducation[i].institution,
          faculty: this.userEducation[i].faculty,
          level: this.userEducation[i].level,
          statuss: this.userEducation[i].statuss,
          time: this.userEducation[i].time,
        });
      }
    },
    checkForm() {
      this.errors = [];
      this.validateEducation();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateEducation() {
      const institutionError = "Institution required.";
      const statussError = "Statuss required.";
      const timeError = "Time required.";

      for (let i = 0; i < this.educations.length; i++) {
        if (
          !this.educations[i].institution &&
          !this.errors.includes(institutionError)
        ) {
          this.errors.push(institutionError);
        }
        if (
          !this.educations[i].statuss &&
          !this.errors.includes(statussError)
        ) {
          this.errors.push(statussError);
        }
        if (!this.educations[i].time && !this.errors.includes(timeError)) {
          this.errors.push(timeError);
        }
      }
    },
    addEducation() {
      this.educations.push({
        educationId: 0,
        userId: this.userBasicData.user_Id,
        institution: "",
        faculty: "",
        level: "",
        statuss: "",
        time: "",
      });
    },
    removeEducation(index) {
      if (this.educations[index].educationId == 0) {
        this.educations.splice(index, 1);
      } else {
        this.deleteEducation(this.educations[index].educationId);
      }
    },
    deleteEducation(id) {
      axios
        .post("delete/education", {
          educationId: id,
        })
        .then((response) => {
          console.log("done");
        })
        .catch((error) => {
          console.log(error);
        });
      location.reload();
    },
    editData(educationField) {
      if (this.checkForm()) {
        axios
          .post("update/education", {
            education: educationField,
          })
          .then((response) => {
            console.log("done");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>