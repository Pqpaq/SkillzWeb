using System;
using System.Collections.Generic;
using System.Text;

namespace SkillzWeb
{
    public class EmployeeSkill
    {
        public int Id { get; set; }
        public int EmployeeId { get; set; }
        public int SkillId { get; set; }
        public State Level { get; set; }

        public enum State
        {
            None = 1,
            Learn,
            Complete
        }
    }
}
