using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Logging;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SkillzWeb.Models
{
    public static class Initialize
    {
        public static void Init(IServiceProvider serviceProvider)
        {
            using (var db = new SkillzContext(serviceProvider.GetRequiredService<DbContextOptions<SkillzContext>>()))
            {
                Employee emp1 = new Employee { Surname = "AT", FirstName = "Autotest", SecondName = "Test", Login = "Test", Password = "Q1234567" };
                Job job = new Job { Name = "QA automation" };
                List<Skill> skills = new List<Skill>()
                {
                    new Skill { Name = "Java"},
                    new Skill { Name = "Selenium"},
                    new Skill { Name = "Docker"},
                    new Skill { Name = "C#"},
                    new Skill { Name = "Python"},
                    new Skill { Name = "TeamCity"},
                    new Skill { Name = "Jenkins"},
                    new Skill { Name = "Selenoid"}
                };

                db.Employees.Add(emp1);
                db.Jobs.Add(job);

                db.Skills.AddRange(skills.ToArray());
                db.SaveChanges();

                emp1 = db.Employees.ToList().FirstOrDefault();
                job = db.Jobs.ToList().FirstOrDefault();

                JobForEmployee jfe = new JobForEmployee { EmployeeId = emp1.Id, JobId = job.Id };

                db.JobForEmployees.Add(jfe);
                db.SaveChanges();

                skills = db.Skills.ToList();

                foreach (var s in skills)
                {
                    db.SkillsForJobs.Add(new SkillsForJob { JobId = job.Id, SkillId = s.Id });
                }

                foreach (var s in skills)
                {
                    if (s.Name == "Python")
                        db.EmployeeSkills.Add(new EmployeeSkill { EmployeeId = emp1.Id, SkillId = s.Id, Level = EmployeeSkill.State.None });
                    else if (s.Name == "Docker" || s.Name == "Java")
                        db.EmployeeSkills.Add(new EmployeeSkill { EmployeeId = emp1.Id, SkillId = s.Id, Level = EmployeeSkill.State.Learn });
                    else
                        db.EmployeeSkills.Add(new EmployeeSkill { EmployeeId = emp1.Id, SkillId = s.Id, Level = EmployeeSkill.State.Complete });

                }

                db.SaveChanges();

            }
        }
    }
}
