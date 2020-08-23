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
    [Route("api/SkillsForJobs")]
    [ApiController]
    public class SkillsForJobsController : ControllerBase
    {
        private readonly SkillzContext _context;

        public SkillsForJobsController(SkillzContext context)
        {
            _context = context;
        }

        // GET: api/SkillsForJobs
        [HttpGet]
        public async Task<ActionResult<IEnumerable<SkillsForJob>>> GetSkillsForJobs()
        {
            return await _context.SkillsForJobs.ToListAsync();
        }

        // GET: api/SkillsForJobs/5
        [HttpGet("{id}")]
        public async Task<ActionResult<SkillsForJob>> GetSkillsForJob(int id)
        {
            var skillsForJob = await _context.SkillsForJobs.FindAsync(id);

            if (skillsForJob == null)
            {
                return NotFound();
            }

            return skillsForJob;
        }

        // PUT: api/SkillsForJobs/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutSkillsForJob(int id, SkillsForJob skillsForJob)
        {
            if (id != skillsForJob.Id)
            {
                return BadRequest();
            }

            _context.Entry(skillsForJob).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!SkillsForJobExists(id))
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

        // POST: api/SkillsForJobs
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPost]
        public async Task<ActionResult<SkillsForJob>> PostSkillsForJob(SkillsForJob skillsForJob)
        {
            _context.SkillsForJobs.Add(skillsForJob);
            await _context.SaveChangesAsync();

            return CreatedAtAction(nameof(GetSkillsForJob), new { id = skillsForJob.Id }, skillsForJob);
        }

        // DELETE: api/SkillsForJobs/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<SkillsForJob>> DeleteSkillsForJob(int id)
        {
            var skillsForJob = await _context.SkillsForJobs.FindAsync(id);
            if (skillsForJob == null)
            {
                return NotFound();
            }

            _context.SkillsForJobs.Remove(skillsForJob);
            await _context.SaveChangesAsync();

            return skillsForJob;
        }

        private bool SkillsForJobExists(int id)
        {
            return _context.SkillsForJobs.Any(e => e.Id == id);
        }
    }
}
