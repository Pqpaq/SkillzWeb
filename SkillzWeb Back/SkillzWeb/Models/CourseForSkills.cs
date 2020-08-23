using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SkillzWeb.Models
{
    public class CourseForSkills
    {
        public int Id { get; set; }
        public int CourseId { get; set; }
        public int SkillId { get; set; }
    }
}
