using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SkillzWeb.Controllers
{
    public class Metods
    {
        private readonly SkillzContext _context;

        public Metods(SkillzContext context)
        {
            _context = context;
        }


        /// <summary>
        /// Метод возвращает список id скилов для изучения
        /// </summary>
        /// <param name="jobId"> id должности </param>
        /// <param name="employeeId"> id сотрудника </param>
        /// <returns> список id скилов для изучения</returns>
        public List<int> CompetenceList(int jobId, int employeeId)
        {
            List<int> listSkillsJobId = new List<int>();          // Список id компетенций для нужной работы
            List<int> listSkillsEmployee = new List<int>();       // Список id компетенций сотрудника
            List<int> skills = new List<int>();
            // Находим нужные компетенции
            foreach (var skillForJob in _context.SkillsForJobs)
            {
                if (skillForJob.JobId.Equals(jobId))
                    listSkillsJobId.Add(skillForJob.SkillId);
            }
            // Находим компетенции сотрудника
            foreach (var employeeSkils in _context.EmployeeSkills)
            {
                if (employeeSkils.EmployeeId.Equals(employeeId))
                    listSkillsEmployee.Add(employeeSkils.SkillId);
            }
            // Cписок компетенций необходимых к изучению
            bool flag = true;
            foreach (int jobSkill in listSkillsJobId)
            {
                flag = true; ;
                foreach (int empSkill in listSkillsEmployee)
                {
                    if (empSkill.Equals(jobSkill))
                    {
                        flag = false;
                        break;
                    }
                }
                if (flag)
                    skills.Add(jobSkill);
            }
            return skills;
        }
        


        public List<int> CourseList(List<int> skillsIds)
        {
            List<int> listSkillsJobId = new List<int>();          // Список id компетенций для нужной работы
            List<int> listSkillsEmployee = new List<int>();       // Список id компетенций сотрудника
            List<int> CourseIds = new List<int>();

            // Находим нужные курсы
            foreach (int skill in skillsIds)
            {


            }

            return CourseIds;
        }



    }
}
