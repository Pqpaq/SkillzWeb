using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using SkillzWeb;

namespace SkillzWeb.Controllers
{
    [Route("api/JobForEmployees")]
    [ApiController]
    public class JobForEmployeesController : ControllerBase
    {
        private readonly SkillzContext _context;

        public JobForEmployeesController(SkillzContext context)
        {
            _context = context;
        }

        // GET: api/JobForEmployees
        [HttpGet]
        public async Task<ActionResult<IEnumerable<JobForEmployee>>> GetJobForEmployees()
        {
            return await _context.JobForEmployees.ToListAsync();
        }

        // GET: api/JobForEmployees/5
        [HttpGet("{id}")]
        public async Task<ActionResult<JobForEmployee>> GetJobForEmployee(int id)
        {
            var jobForEmployee = await _context.JobForEmployees.FindAsync(id);

            if (jobForEmployee == null)
            {
                return NotFound();
            }

            return jobForEmployee;
        }

        // PUT: api/JobForEmployees/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutJobForEmployee(int id, JobForEmployee jobForEmployee)
        {
            if (id != jobForEmployee.Id)
            {
                return BadRequest();
            }

            _context.Entry(jobForEmployee).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!JobForEmployeeExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/JobForEmployees
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPost]
        public async Task<ActionResult<JobForEmployee>> PostJobForEmployee(JobForEmployee jobForEmployee)
        {
            _context.JobForEmployees.Add(jobForEmployee);
            await _context.SaveChangesAsync();

            return CreatedAtAction(nameof(GetJobForEmployee), new { id = jobForEmployee.Id }, jobForEmployee);
        }

        // DELETE: api/JobForEmployees/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<JobForEmployee>> DeleteJobForEmployee(int id)
        {
            var jobForEmployee = await _context.JobForEmployees.FindAsync(id);
            if (jobForEmployee == null)
            {
                return NotFound();
            }

            _context.JobForEmployees.Remove(jobForEmployee);
            await _context.SaveChangesAsync();

            return jobForEmployee;
        }

        private bool JobForEmployeeExists(int id)
        {
            return _context.JobForEmployees.Any(e => e.Id == id);
        }
    }
}
