using Microsoft.EntityFrameworkCore;
using SkillzWeb.Models;
using System;
using System.Collections.Generic;
using System.Text;

namespace SkillzWeb
{
    public class SkillzContext : DbContext
    {
        public SkillzContext(DbContextOptions<SkillzContext> options) : base(options)
        {
            Database.EnsureCreated();
        }

        public DbSet<Employee> Employees { get; set; }
        public DbSet<EmployeeSkill> EmployeeSkills { get; set; }
        public DbSet<Job> Jobs { get; set; }
        public DbSet<JobForEmployee> JobForEmployees { get; set; }
        public DbSet<Skill> Skills { get; set; }
        public DbSet<SkillsForJob> SkillsForJobs { get; set; }
        public DbSet<CourseForSkills> CourseForSkills { get; set; }
    }
}
